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
 *   Class Message
 *
 * Used in:
 *   lol-status (v3)
 *     @link https://developer.riotgames.com/api-methods/#lol-status-v3/GET_getShardData
 *
 * @iterable $translations
 *
 * @package RiotAPI\LeagueAPI\Objects
 */
class Message extends ApiObjectIterable
{
	/** @var string $severity */
	public $severity;

	/** @var string $author */
	public $author;

	/** @var string $created_at */
	public $created_at;

	/** @var Translation[] $translations */
	public $translations;

	/** @var string $updated_at */
	public $updated_at;

	/** @var string $content */
	public $content;

	/** @var string $id */
	public $id;
}
