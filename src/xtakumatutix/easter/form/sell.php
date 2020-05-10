<?php
namespace xtakumatutix\easter\form;

use pocketmine\form\Form;
use pocketmine\Player;

class sell implements Form
{
    public function handleResponse(Player $player, $data): void
    {

        $player->sendMessage($data ?
            '売る' :
            'キャンセルした');
    }

    public function jsonSerialize()
    {
        return [
            'type' => 'modal',
            'title' => 'ModalForm',
            'content' => 'ダミー',
            'button1' => '§a売る',
            'button2' => '§cキャンセル'
        ];
    }
}