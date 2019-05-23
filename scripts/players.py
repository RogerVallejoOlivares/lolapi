import cassiopeia as cass
from cassiopeia import Summoner, Match
from cassiopeia.data import Season, Queue, Region
from collections import Counter

import sys

API_KEY = 'RGAPI-0d273916-77fd-4673-8af7-c93c604379dd'
API_REGION = Region.europe_west
CURRENT_SEASON = Season.season_8
QUEUES = {Queue.ranked_solo_fives}
COMPUTABLE_MATCH_COUNT = 5

settings = cass.get_default_config()
settings['logging']['print_calls'] = False
cass.apply_settings(settings)

cass.set_riot_api_key(API_KEY)  # This overrides the value set in your configuration/settings.
cass.set_default_region(API_REGION)

def get_matches_from_summoner(summoner):
    match_history = summoner.match_history#cass.get_match_history(summoner=summoner, queues={Queue.ranked_solo_fives})
    match_history(seasons={CURRENT_SEASON}, queues=QUEUES)

    match_count = 0
    kdas = []
    for m in match_history:
        for p in m.participants:
            summoner_name = p.summoner.name
            account_id = p.summoner.account_id
            summoner_id = p.summoner.id
            kda = p.stats.kda
            ranks = summoner.ranks

            kdas.append(kda)
            match_count = match_count + 1

            #print('name: %s, kda: %s' % (summoner_name, kda))
            for q in QUEUES:
                r = ranks[q]
                print('match #%d: queue: %s, tier: %s, division: %s [KDA: %f]' % (match_count, q, r.tier, r.division, kda))

            break

        if (match_count == COMPUTABLE_MATCH_COUNT):
            break

    average_kda = sum(kdas) / match_count
    print('player %s has an average kda of %f in the last %d matches' % (summoner.name, average_kda, match_count))


def main():
    summoner = Summoner(name='matalords', region=API_REGION)
    get_matches_from_summoner(summoner)

if __name__ == "__main__":
    main()
