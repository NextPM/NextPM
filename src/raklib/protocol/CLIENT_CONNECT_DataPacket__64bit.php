<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

namespace raklib\protocol;

use raklib\Binary;





//#define $this->getFloat() (Binary::readFloat($this->get(4)))
//#define $this->getFloat(accuracy) (Binary::readFloat($this->get(4), accuracy))

//#define $this->getLFloat() (Binary::readLFloat($this->get(4)))
//#define $this->getLFloat(accuracy) (Binary::readLFloat($this->get(4), accuracy))





class CLIENT_CONNECT_DataPacket extends Packet{
	public static $ID = 0x09;

	public $clientID;
	public $sendPing;
	public $useSecurity = \false;

	public function encode(){
		parent::encode();
		($this->buffer .= (\pack("NN", $this->clientID >> 32, $this->clientID & 0xFFFFFFFF)));
		($this->buffer .= (\pack("NN", $this->sendPing >> 32, $this->sendPing & 0xFFFFFFFF)));
		($this->buffer .= \chr($this->useSecurity ? 1 : 0));
	}

	public function decode(){
		parent::decode();
		$this->clientID = (Binary::readLong($this->get(8)));
		$this->sendPing = (Binary::readLong($this->get(8)));
		$this->useSecurity = (\ord($this->get(1))) > 0;
	}
}
