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

namespace pocketmine\network\mcpe\protocol;

#include <rules/DataPacket.h>

use pocketmine\math\Vector3;
use pocketmine\network\mcpe\NetworkSession;

class SetActorMotionPacket extends DataPacket{
	const NETWORK_ID = ProtocolInfo::SET_ACTOR_MOTION_PACKET;

	public $eid;
	public $motionX;
	public $motionY;
	public $motionZ;

	public function decode(){
		$this->eid = $this->getEntityRuntimeId();
		$this->getVector3f($this->motionX, $this->motionY, $this->motionZ);
	}

	public function encode(){
		$this->putEntityRuntimeId($this->eid);
		$this->putVector3f($this->motionX, $this->motionY, $this->motionZ);
	}

	public function handle(NetworkSession $session) : bool{
		return $session->handleSetActorMotion($this);
	}

}
