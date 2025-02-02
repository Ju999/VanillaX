<?php

namespace CLADevs\VanillaX\inventories\types;

use CLADevs\VanillaX\inventories\FakeBlockInventory;
use pocketmine\block\BlockLegacyIds;
use pocketmine\item\Item;
use pocketmine\network\mcpe\protocol\ActorEventPacket;
use pocketmine\network\mcpe\protocol\FilterTextPacket;
use pocketmine\network\mcpe\protocol\ServerboundPacket;
use pocketmine\network\mcpe\protocol\types\ActorEvent;
use pocketmine\network\mcpe\protocol\types\inventory\WindowTypes;
use pocketmine\player\Player;
use pocketmine\world\Position;
use pocketmine\world\sound\AnvilUseSound;

class AnvilInventory extends FakeBlockInventory{

    public function __construct(Position $holder){
        parent::__construct($holder, 3, BlockLegacyIds::AIR, WindowTypes::ANVIL, null);
    }

    public function handlePacket(Player $player, ServerboundPacket $packet): bool{
        if($packet instanceof ActorEventPacket && $packet->eventId === ActorEvent::PLAYER_ADD_XP_LEVELS){
            if(!$player->isCreative()){
                $player->getXpManager()->setXpLevel($player->getXpManager()->getXpLevel() - abs($packet->eventData));
            }
        }elseif($packet instanceof FilterTextPacket){
            $player->getNetworkSession()->sendDataPacket(FilterTextPacket::create($packet->getText(), true));
        }
        return true;
    }

    /**
     * @param Player $player, returns player who successfully repaired/renamed their item
     * @param Item $item, returns a new item after its repaired/renamed
     */
    public function onSuccess(Player $player, Item $item): void{
        $player->getWorld()->addSound($this->getHolder(), new AnvilUseSound());
    }

    public function handleSlotChange(): void{
    }

    public function handleResult(): void{
    }
}