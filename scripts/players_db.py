import mysql.connector, sys, json

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
    result = cursor.fetchall()

    for x in result:
        print(x[0])


def load_players():
    global player_history
    try:
        with open(OUTPUT_FILE, 'r') as f:
            player_history = json.load(f)
    except:
        pass

if __name__ == '__main__':
    cursor = setup_db()
    if not cursor:
        print('[-] cannot connect to db')
        sys.exit()

    load_players()
    print('player exists? %s' % ('YES' if player_exists(cursor, 'matalords') else 'no'))
    get_leagues(cursor)
