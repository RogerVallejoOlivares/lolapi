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

namespace RiotAPI\LeagueAPI\Objects\StaticData;

use RiotAPI\LeagueAPI\Objects\ApiObjectIterable;


/**
 *   Class StaticItemListDto
 * This object contains item list data.
 *
 * Used in:
 *   lol-static-data (v3)
 *     @link https://developer.riotgames.com/api-methods/#lol-static-data-v3/GET_getItemList
 *
 * @iterable $data
 *
 * @package RiotAPI\LeagueAPI\Objects\StaticData
 */
class StaticItemListDto extends ApiObjectIterable
{
	/** @var StaticItemDto[] $data */
	public $data;

	/** @var string $version */
	public $version;

	/** @var StaticItemTreeDto[] $tree */
	public $tree;

	/** @var StaticGroupDto[] $groups */
	public $groups;

	/** @var string $type */
	public $type;
}
