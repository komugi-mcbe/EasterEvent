<?php

namespace xtakumatutix\easter;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\Player;
use pocketmine\item\Item;

Class Main extends PluginBase implements Listener {

    const Wood_Egg="§6木§fの§e卵§r";
    const Dirt_Egg="§g土§fの§e卵§r";
    const Sand_Egg="§g砂§fの§e卵§r";
    const Stone_Egg="§7石§fの§e卵§r";
    const Leef_Egg="§a葉っぱ§fの§e卵§r";
    const Sky_Egg="§b空§fの§e卵§r";

    public function onEnable() {
        $this->getLogger()->notice("読み込み完了_ver.1.0.0");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onBreak(BlockBreakEvent $event) {
        $player = $event->getPlayer();
        $block = $event->getBlock()->getID();

        if ($player->getLevel()->getName() == "event") {

            if ($block === 17 and mt_rand(0, 3) === 1) {
                self::addegg($player, self::Wood_Egg);
            }

            if ($block === 2 or $block === 3) {
                if (mt_rand(0, 5) === 5) {
                    self::addegg($player, self::Dirt_Egg);
                }
            }

            if ($block == 1 and mt_rand(0, 6) === 3) {
                self::addegg($player, self::Stone_Egg);
            }

            if ($block === 18 and mt_rand(0, 3) === 1) {
                self::addegg($player, self::Leef_Egg);
            }

            if ($block === 12 and mt_rand(0, 4) === 1) {
                self::addegg($player, self::Sand_Egg);
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
    }

}