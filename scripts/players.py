import cassiopeia as cass
from cassiopeia import Summoner, Match
from cassiopeia.data import Season, Queue, Region
from collections import Counter

from datetime import datetime
import sys, json

# constants
API_KEY = 'RGAPI-ed3facc5-b751-4caa-9e38-b8f282455a53'
API_REGION = Region.europe_west
CURRENT_SEASON = Season.season_9
QUEUES = {Queue.ranked_solo_fives}
COMPUTABLE_MATCH_COUNT = 5
OUTPUT_FILE = 'players.json'
player_history = {}
SAVE_AFTER_RECORD = True
TIME_DIFFERENCE_CHECK = 1 # in hours

# library settings
settings = cass.get_default_config()
settings['logging']['print_calls'] = False
cass.apply_settings(settings)

cass.set_riot_api_key(API_KEY)  # This overrides the value set in your configuration/settings.
cass.set_default_region(API_REGION)

# functions

def load_players():
    global player_history
    try:
        with open(OUTPUT_FILE, 'r') as f:
            player_history = json.load(f)
    except:
        pass

def save_players():
    try:
        with open(OUTPUT_FILE, 'w') as f:
            json.dump(player_history, f, indent=4, default=str)
    except:
        raise

def save_match(participant, match):
    summoner_name = None
    account_id = None
    summoner_id = None
    kda = None
    ranks = None

    try:
        summoner_name = participant.summoner.name
        account_id = participant.summoner.account_id
        summoner_id = participant.summoner.id
        kda = participant.stats.kda
        ranks = participant.summoner.ranks
    except:
        pass

    if not summoner_name or not account_id or not summoner_id or not kda or not ranks:
        return

    if summoner_name not in player_history:
        player_history[summoner_name] = {
            'accountId': account_id,
            'summonerId': summoner_id,
            'lastCheck': datetime.now()
        }

    for q in QUEUES:
        if not q in ranks:
            continue

        r = ranks[q]
        print('id: %d, tier: %s, division: %s [KDA: %f]' % (match.id, r.tier, r.division, kda))

        queue_name = str(q.value)
        if not queue_name in player_history[summoner_name]:
            player_history[summoner_name][queue_name] = {}

        match_id = str(match.id)
        if not match_id in player_history[summoner_name][queue_name]:
            player_history[summoner_name][queue_name][match_id] = {
                'kda': kda,
                'tier': str(r.tier),
                'division': str(r.division)
            }

        if SAVE_AFTER_RECORD:
            save_players()

def get_matches_from_summoner(summoner, recursive = False):
    match_history = None
    try:
        match_history = summoner.match_history#cass.get_match_history(summoner=summoner, queues={Queue.ranked_solo_fives})
        match_history(seasons={CURRENT_SEASON}, queues=QUEUES, end_index=COMPUTABLE_MATCH_COUNT)
    except:
        return

    match_count = 0

    if recursive:
        for m in match_history:
            for p in m.participants:
                match_count = match_count + 1
                save_match(p, m)

                if (match_count == COMPUTABLE_MATCH_COUNT):
                    break
    else:
        for m in match_history:
            p = m.participants[summoner]
            match_count = match_count + 1
            save_match(p, m)

            if (match_count == COMPUTABLE_MATCH_COUNT):
                break

# main
def main(recursive = False):
    for p in player_history:
        for q in QUEUES:
            queue_name = str(q.value)
            if not queue_name in player_history[p]:
                player_history[p][queue_name] = {}

            player_match_count = len(player_history[p][queue_name])
            print('player %s has %d matches in queue %s' % (p, player_match_count, queue_name))
            if player_match_count < COMPUTABLE_MATCH_COUNT:
                #if 'lastCheck' in player_history[p]:
                #    hours_elapsed = hours_elapsed_from_now(player_history[p]['lastCheck'])
                #    if hours_elapsed <= TIME_DIFFERENCE_CHECK:
                #        print('checked in less than %d hours' % (TIME_DIFFERENCE_CHECK))
                #else:
                if True:
                    player_history[p]['lastCheck'] = datetime.now()
                    summoner = Summoner(name=p, region=API_REGION)
                    get_matches_from_summoner(summoner, recursive)
                    print('\tnow have %d matches' % len(player_history[p][queue_name]))

        if SAVE_AFTER_RECORD:
            save_players()


def hours_elapsed_from_now(d):
    current_date = datetime.now()
    if not isinstance(d, datetime):
        d = datetime.strptime(d, "%Y-%m-%d %H:%M:%S.%f")
    delta = current_date - d
    return ((delta.days * 24) + (delta.seconds) / 3600)

if __name__ == "__main__":
    load_players()
    print('there are %d players' % (len(player_history)))

    #amigos_de_roger = ['Atzur', 'victorcr', 'mapilol', 'NashiraK', 'inferno0529', 'Amazing Onichan', 'D3VILJHO', 'Palxic']

    #random_players = ['damm1313', 'Blomster Finn', 'FatShield', 'IRoxas', 'OCE Import', 'MidN9t']
    random_players = ['Blomster Finn', 'FatShield', 'IRoxas', 'OCE Import', 'MidN9t']

    if False:
        for a in random_players:
            print(a)
            summoner = Summoner(name=a, region=API_REGION)
            get_matches_from_summoner(summoner, True)

    main(False)
    save_players()
