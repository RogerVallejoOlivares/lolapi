<?php

/**
 * Copyright (C) 2016-2019  Daniel Dolejška
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace RiotAPI\LeagueAPI\Objects;


/**
 *   Class TeamBansDto
 *
 * Used in:
 *   match (v4)
 *     @link https://developer.riotgames.com/api-methods/#match-v4/GET_getMatchIdsByTournamentCode
 *     @link https://developer.riotgames.com/api-methods/#match-v4/GET_getMatchByTournamentCode
 *
 * @linkable getStaticChampion($championId)
 *
 * @package RiotAPI\LeagueAPI\Objects
 */
class TeamBansDto extends ApiObjectLinkable
{
	/**
	 *   Turn during which the champion was banned.
	 *
	 * @var int $pickTurn
	 */
	public $pickTurn;

	/**
	 *   Banned championId.
	 *
	 * @var int $championId
	 */
	public $championId;
}
