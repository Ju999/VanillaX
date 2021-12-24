<?php

namespace CLADevs\VanillaX\blocks\block;

use CLADevs\VanillaX\blocks\utils\BlockVanilla;
use CLADevs\VanillaX\blocks\utils\facing\BlockFacingOppositeTrait;
use CLADevs\VanillaX\items\ItemIdentifiers;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\block\Transparent;

class ChainBlock extends Transparent{
    use BlockFacingOppositeTrait;

    public function __construct(){
        parent::__construct(new BlockIdentifier(BlockVanilla::CHAIN, 0, ItemIdentifiers::CHAIN), "Chain", new BlockBreakInfo(5, BlockToolType::PICKAXE, 0, 6));
    }
}