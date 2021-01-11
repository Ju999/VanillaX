<?php

namespace CLADevs\VanillaX\entities\passive;

use CLADevs\VanillaX\entities\LivingEntity;
use CLADevs\VanillaX\entities\traits\EntityAgeable;
use pocketmine\item\ItemIds;

class SheepEntity extends LivingEntity{

    public $width = 0.9;
    public $height = 1.3;

    const NETWORK_ID = self::SHEEP;

    protected function initEntity(): void{
        parent::initEntity();
        $this->ageable = new EntityAgeable($this, [0.45, 0.65], [0.9, 1.3]);
        $this->ageable->setGrowthItems([ItemIds::WHEAT]);
        $this->setMaxHealth(8);
    }

    public function getName(): string{
        return "Sheep";
    }
}