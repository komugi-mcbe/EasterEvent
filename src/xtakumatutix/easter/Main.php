<?php

namespace xtakumatutix\easter;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\Player;
use pocketmine\item\Item;

Class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getLogger()->notice("読み込み完了_ver.1.0.0");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onBreak(BlockBreakEvent $event) {
        $player = $event->getPlayer();
        $block = $event->getBlock()->getID();

        if ($player->getLevel()->getName() == "event") {

            if ($block === 17 and mt_rand(0, 1) === 1) {
                self::addegg($player, "§6木§fの§e卵§r");
            }

            if ($block === 2 or $block === 3) {
                if (mt_rand(0, 1) === 1) {
                    self::addegg($player, "§6土§fの§e卵§r");
                }
            }

            if ($block == 1 and mt_rand(0, 1) === 1) {
                self::addegg($player, "§7石§fの§e卵§r");

            }

            if ($block === 18 and mt_rand(0, 1) === 1) {
                self::addegg($player, "§a葉っぱ§fの§e卵§r");

            }
        }
    }

    public static function addegg(Player $player, string $eggname) {
        if (!$player->getInventory()->canAddItem(Item::get(344, 0, 1))) {
            $player->sendMessage(" >> おっと卵をゲットしたのにインベントリがいっぱいで、捨てちゃった...");
            return;
        }
        $item = Item::get(344, 0, 1);
        $item->setCustomName($eggname);
        $player->getInventory()->addItem($item);
        $player->sendMessage("§a >> {$eggname}をゲット！");
    }

}