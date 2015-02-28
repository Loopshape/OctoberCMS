<?php namespace DarkEye\MoreTag;

/*
	More Tag for October CMS
	Copyright (C) 2014 by  Iñigo 'Dark_eye' Ruiz (http://d-eye.eu)

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

class Plugin extends \System\Classes\PluginBase
{
	public function pluginDetails()
	{
		return [
		    'name' => 'More Tag',
		    'description' => 'Provides a Twig filter to implement a "ReadMore" tag.',
		    'author' => 'Dark_eye',
		    'icon' => 'icon-ellipsis-h'
		];
	}

	public function registerMarkupTags()
	{
		return [
			'filters' => [
			'untilMore' => [$this, 'returnTextUntilMore']
			]
		];
	}

	public function returnTextUntilMore($text, $parameters="")
	{
		preg_match_all('/.*<!--more\s?(.*)-->/s', $text, $matches);
		
		if (!isset($matches[0][0])) return $text;
		return substr($matches[0][0],0,strlen($matches[0][0])-strlen($matches[1][0])-12) . ($parameters!="" ? ' <a href="'.$parameters.'">'.$matches[1][0].'</a>' : '...');
	}
}