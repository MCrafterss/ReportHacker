<?php

  namespace ReportHacker;

  use pocketmine\plugin\PluginBase;
  use pocketmine\event\Listener;
  use pocketmine\utils\TextFormat as TF;
  use pocketmine\Player;
  use pocketmine\command\Command;
  use pocketmine\command\CommandSender;

  class Main extends PluginBase implements Listener{

    public function onEnable(){
      $this->getServer()->getPluginManager()->registerEvents($this, $this);
      $this->getServer()->getLogger()->info(TF::GREEN . "ReportHacker by MCrafters has Been Enabled!");
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
      if(strtolower($cmd->getName()) === "reporthacker"){
        if(!(isset($args[0]))){
          $sender->sendMessage(TF::RED . "Error: Not Enough Parameters. Usage: /reporthacker <player>");
          return true;
        }else{
          $sender_name = $sender->getName();
          $sender_display_name = $sender->getDisplayName();
          $name = $args[0];
          $player = $this->getServer()->getPlayer($name);
          if($player === null){
            foreach($this->getServer()->getOnlinePlayers() as $p){
              if($p->hasPermission("rh.admin")){
                $p->sendMessage(TF::YELLOW . $sender_name . " reported " . $name . " for using hacks and/or mods!");
              }
            }
            $sender->sendMessage(TF::GREEN . "The Report has Been Sent to All Online Administrators.");
            return true;
          }else{
            foreach($this->getServer()->getOnlinePlayers() as $p){
              if($p->hasPermission("rh.admin")){
                $p->sendMessage(TF::YELLOW . $sender_name . " reported " . $name . " for using hacks and/or mods!");
              }
            }
            $player->sendMessage(TF::YELLOW . $sender_name . " has reported you for using hacks and/or mods!");
            $sender->sendMessage(TF::GREEN . "The Report has Been Sent to All Online Administrators.");
            return true;
          }
        }
      }
    }
    
    public function onDisable(){
      $this->getServer()->getLogger()->info(TF::RED . "ReportHacker by MCrafters has Been Disabled!");
    }
    
  }
