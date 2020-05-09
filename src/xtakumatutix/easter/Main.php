<?php

namespace xtakumatutix\easter;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerBucketEvent;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;

Class Main extends PluginBase implements Listener {

    const Wood_Egg="§6木§fの§e卵§r";
    const Dirt_Egg="§g土§fの§e卵§r";
    const Sand_Egg="§g砂§fの§e卵§r";
    const Stone_Egg="§7石§fの§e卵§r";
    const Leef_Egg="§2葉っぱ§fの§e卵§r";
    const Sky_Egg="§b空§fの§e卵§r";
    const Water_Egg="§1海§fの§e卵§r";

    public function onEnable() {
        $this->getLogger()->notice("読み込み完了_ver.1.0.0");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
	
	/**
     * @ignoreCancelled
     */
	public function onBreak(BlockBreakEvent $event) {
        $player = $event->getPlayer();
        $block = $event->getBlock()->getID();

        if ($player->getLevel()->getName() == "event") {
			switch ($block){
                case 17:
                    if(mt_rand(0,10) === 3) self::addegg($player, self::Wood_Egg);
                    break;

                case 2:
                case 3:
					if (mt_rand(0, 39) === 15) self::addegg($player, self::Dirt_Egg);
                    break;

                case 1:
                    if(mt_rand(0,30) === 6) self::addegg($player, self::Stone_Egg);
                    break;

                case 18:
                    if(mt_rand(0,21) === 12) self::addegg($player, self::Leef_Egg);
                    break;

                case 12:
                    if(mt_rand(0,32) === 21) self::addegg($player, self::Sand_Egg);
                    break;
            }
		}
	}

    public function bucket(PlayerBucketEvent $event) {
    	$player = $event->getPlayer();
    	$id = $event->getItem()->getID();
    	$damage = $event->getItem()->getDamage();

    	if ($player->getLevel()->getName() == "event") {

    		if ($id == 325) {
    			if ($damage == 8 and mt_rand(0, 2) === 1) {
    				self::addegg($player, self::Water_Egg);
    			}
    		}
    	}
    }

    public static function addegg(Player $player, string $eggname) {
        if (!$player->getInventory()->canAddItem(Item::get(344, 0, 1))) {
            $player->sendMessage("§c >> §fおっと卵をゲットしたのにインベントリがいっぱいで、捨てちゃった...");
            return;
        }
        $item = Item::get(344, 0, 1);
        $item->setCustomName($eggname);
        $item->setLore(["[Event:Easter]"]);
        $player->getInventory()->addItem($item);
        $player->sendMessage("§a >> {$eggname}をゲット！");
        $pk = new PlaySoundPacket();
        $pk->soundName = 'random.levelup';
        $pk->x = $player->x;
        $pk->y = $player->y;
        $pk->z = $player->z;
        $pk->volume = 1;
        $pk->pitch = 1;
        $player->dataPacket($pk);
    }

}
