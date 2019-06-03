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
 *   Class TournamentCodeDto
 *
 * Used in:
 *   tournament (v4)
 *     @link https://developer.riotgames.com/api-methods/#tournament-v4/GET_getTournamentCode
 *
 * @package RiotAPI\LeagueAPI\Objects
 */
class TournamentCodeDto extends ApiObject
{
	/**
	 *   The game map for the tournament code game.
	 *
	 * @var string $map
	 */
	public $map;

	/**
	 *   The tournament code.
	 *
	 * @var string $code
	 */
	public $code;

	/**
	 *   The spectator mode for the tournament code game.
	 *
	 * @var string $spectators
	 */
	public $spectators;

	/**
	 *   The tournament code's region. (Legal values: BR, EUNE, EUW, JP, LAN, LAS, 
	 * NA, OCE, PBE, RU, TR).
	 *
	 * @var string $region
	 */
	public $region;

	/**
	 *   The provider's ID.
	 *
	 * @var int $providerId
	 */
	public $providerId;

	/**
	 *   The team size for the tournament code game.
	 *
	 * @var int $teamSize
	 */
	public $teamSize;

	/**
	 *   The summonerIds of the participants (Encrypted).
	 *
	 * @var string[] $participants
	 */
	public $participants;

	/**
	 *   The pick mode for tournament code game.
	 *
	 * @var string $pickType
	 */
	public $pickType;

	/**
	 *   The tournament's ID.
	 *
	 * @var int $tournamentId
	 */
	public $tournamentId;

	/**
	 *   The lobby name for the tournament code game.
	 *
	 * @var string $lobbyName
	 */
	public $lobbyName;

	/**
	 *   The password for the tournament code game.
	 *
	 * @var string $password
	 */
	public $password;

	/**
	 *   The tournament code's ID.
	 *
	 * @var int $id
	 */
	public $id;

	/**
	 *   The metadata for tournament code.
	 *
	 * @var string $metaData
	 */
	public $metaData;
}
