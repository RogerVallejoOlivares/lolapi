import mysql.connector, sys, json

COMPUTABLE_MATCH_COUNT = 5
OUTPUT_FILE = 'players.json'
player_history = {}

db = mysql.connector.connect(
    host = 'localhost',
    user = 'pi',
    password = 'destroyer23',
    database = 'lolapi'
)

def setup_db():
    cursor = None
    if db:
        cursor = db.cursor()

    return cursor

def player_exists(cursor, player_name):
    cursor.execute('SELECT * FROM player WHERE name = %s;', (player_name,))
    result = cursor.fetchone()
    return (result or None)

def get_leagues(cursor):
    cursor.execute('SELECT * FROM league;')
    leagues = cursor.fetchall()
    return leagues

def get_league_id_by_name(name):
    cursor.execute('SELECT leagueid FROM league WHERE name = %s;', (name,))
    result = cursor.fetchone()
    return (result[0] or None)

def load_players():
    global player_history
    try:
        with open(OUTPUT_FILE, 'r') as f:
            player_history = json.load(f)
    except:
        pass

def insert_player(cursor, name, account_id, summoner_id, kda, match_count, league_id, league_division):
    cursor.execute('SELECT numMatches FROM player WHERE name = %s;', (name,))
    result = cursor.fetchone()
    if result:
        current_match_count = int(result[0]) or 0
        if current_match_count >= match_count:
            return

        cursor.execute('UPDATE player SET kda = %s, numMatches = %s, leagueId = %s, leagueRank = %s WHERE name = %s;', (kda, match_count, league_id, league_division, name, ))
    else:
        cursor.execute('INSERT INTO player (accountId, summonerId, KDA, numMatches, name, leagueId, leagueRank) VALUES (%s, %s, %s, %s, %s, %s, %s);', (account_id, summoner_id, kda, match_count, name, league_id, league_division, ))

if __name__ == '__main__':
    cursor = setup_db()
    if not cursor:
        print('[-] cannot connect to db')
        sys.exit()

    load_players()
    print('loaded %d players' % (len(player_history)))
    leagues = get_leagues(cursor)

    valid_players = 0
    for p in player_history:
        if not 'RANKED_SOLO_5x5' in player_history[p]:
            continue

        matches = player_history[p]['RANKED_SOLO_5x5'] # at the moment there is only one queue so we access it by name
        account_id = player_history[p]['accountId']
        summoner_id = player_history[p]['summonerId']

        match_count = len(matches)
        if match_count < COMPUTABLE_MATCH_COUNT:
            continue

        total_kda = 0
        for m in matches:
            total_kda = total_kda + matches[m]['kda']

        average_kda = "{0:.2f}".format(total_kda / match_count)

        latest_match = max(list(matches))
        latest_league_tier = matches[latest_match]['tier']
        latest_league_division = matches[latest_match]['division']
        latest_league_id = get_league_id_by_name(latest_league_tier)

        #print('player %s: %d total matches with an average kda of %s in %s (%s) %s' % (p, match_count, average_kda, latest_league_tier, latest_league_id, latest_league_division))
        insert_player(cursor, p, account_id, summoner_id, average_kda, match_count, latest_league_id, latest_league_division)
        valid_players = valid_players + 1

        #break

    print('there are %d valid players of %d' % (valid_players, len(player_history)))

    db.commit() # if we do commit after every update/inserte it can take longer than committing at finish
