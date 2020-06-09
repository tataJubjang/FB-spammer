<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Name        : Facebook Bot (fb-bot)
* Author      : DulLah
* Version     : 1.1
* Update      : 06 June 2020
* Facebook    : https://www.facebook.com/dulahz
* Telegram    : https://t.me/DulLah
* Whatsapp    : https://wa.me/6282320748574
* Donate      : Ovo/Dana (6282320748574)
*
* Changing/removing the author's name will not make you a real programmer
* Please respect me for making this tool from the beginning. :)
*/

class Configs extends CI_Model {

  public function __construct() {
    parent::__construct();
    /*
      @Banner please don't remove the author name
    */
    $this->banner = PHP_EOL."
{$this->yellow}                         \ \ {$this->reset}| {$this->yellow}* %s
{$this->yellow}    .-'''''-.    __       |/ {$this->reset}|----------------------------
{$this->yellow}   /         \.'`  `',.--//  {$this->reset}| {$this->yellow}* BOT FOR FACEBOOK [{$this->red}CLI{$this->yellow}]
{$this->yellow} -(  {$this->red}FACEBOOK{$this->yellow} | {$this->red}BOT{$this->yellow}  |  @@\  {$this->reset}| {$this->yellow}* AUTHOR : ModSCK
{$this->yellow}   \         /'.____.'\___|  {$this->reset}| {$this->yellow}* FB   : https://web.facebook.com/Talovejub.270361
{$this->yellow}    '-.....-' __/ | \   (`)  {$this->reset}|----------------------------
{$this->reset}    v1.1 dev{$this->yellow} /   /  /        {$this->reset}| {$this->yellow}* %s
{$this->yellow}                 \  \ \n{$this->reset}".PHP_EOL;
    /*
      @Load modules climate
    */
    include('vendor/autoload.php');
    $this->cli = new League\CLImate\CLImate;
  }

  public function banner() {
    /*
      @Banner please don't remove the author name
    */
    return $this->banner;
  }

  public function clear() {
    if (strtolower(substr(PHP_OS, 0, 3)) === 'lin') {
      system('clear');
    } else
    {
      system('cls');
    }
  }

  public function back_menu() {
    $input = $this->climate->br()->input("  {$this->yellow}Press enter to return menu{$this->reset}");
    $input->prompt();
    $this->return_menu->index();
  }

  public function load_cookies() {
    if (file_exists('log/cookies.txt') and filesize('log/cookies.txt') > 0) {
      /*
      @Read Cookies
      */
      $file = fopen('log/cookies.txt', 'r');
      $cookies = fgets($file);
      fclose($file);
      return $cookies;
    } else
    {
      return false;
    }
  }

  public function list_captions($file) {
    $caption = [];
    $file = fopen('random/'.$file, 'r');
    while (!feof($file)) {
      if (trim(fgets($file))) {
        $caption[] = trim(fgets($file));
      }
    }
    fclose($file);
    return $caption;
  }

  public function climate() {
    return $this->cli;
  }

  public function request_get($url, $cookies = false) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
    curl_setopt($ch, CURLOPT_COOKIE, $cookies);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
      $this->climate->br()->shout('เชื่อมต่อล่มเหลวกรุณาลองไหม่.');
      exit(0);
    }
    curl_close($ch);
    return $response;
  }

  public function request_post($url, $cookies = false, $post) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
    curl_setopt($ch, CURLOPT_COOKIE, $cookies);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
      $this->climate->br()->shout('  ERROE.');
      exit(0);
    }
    curl_close($ch);
    return $response;
  }

  public function show_menu() {
    $menu = json_encode(
      array(
        ['no' => '01', 'name' => 'ลบแชตทั้งหมด'],
        ['no' => '02', 'name' => 'ลบโพสต์ทั้งหมด '],
        ['no' => '03', 'name' => 'ลบเพื่อนทั้งหมด'],
        ['no' => '04', 'name' => 'ลบรูปทั้งหมด'],
        ['no' => '05', 'name' => 'ลบคำขอเป็นเพื่อนทั้งหมด'],
        ['no' => '06', 'name' => 'เข้าร่วมกลุ่มโดยใช้ชื่อการค้นหา'],
        ['no' => '07', 'name' => 'อัปเดตคำบรรยายภาพสถานะแบบสุ่ม'],
        ['no' => '08', 'name' => 'รายการแชทเป็นกลุ่ม'],
        ['no' => '09', 'name' => 'แสปมเมอร์แชต'],
        ['no' => '10', 'name' => 'ออกจากลุ่มทั้งหมด'],
        ['no' => '11', 'name' => 'Mass React'],
        ['no' => '12', 'name' => 'Mass Comments'],
        ['no' => '13', 'name' => 'ความคิดเห็นสแปมในโพสต์เดียว'],
        ['no' => '14', 'name' => 'Mass Posting Groups'],
        ['no' => '15', 'name' => 'Cancel Request Sent'],
        ['no' => '16', 'name' => 'ปลดบล็อคทั้งหมด'],
      )
    );
    return json_decode($menu);
  }

  public function show_menu_update_status() {
    $menu = json_encode(
      array(
        ['no' => '01', 'name' => 'สถานะ'],
        ['no' => '02', 'name' => 'การทำงาน'],
        ['no' => '03', 'name' => 'ประมวน'],
        ['no' => '00', 'name' => 'Back'],
      )
    );
    return json_decode($menu);
  }

  public function show_menu_mass_react() {
    $menu = json_encode(
      array(
        ['no' => '01', 'name' => 'กดใลค์ปั่นโพสต์ ธรรมดา'],
        ['no' => '02', 'name' => 'กดอิโมจิปั่นคนอื่น'],
        ['no' => '03', 'name' => 'กดอิโมจิในกลุ่ม'],
        ['no' => '04', 'name' => 'กดอิโมจิแฟนเพจ'],
        ['no' => '00', 'name' => 'Back'],
      )
    );
    return json_decode($menu);
  }

  public function show_menu_reactions() {
    $menu = json_encode(
      array(
        ['no' => '01', 'name' => 'ใลค์'],
        ['no' => '02', 'name' => 'รัก'],
        ['no' => '03', 'name' => 'ห่วงใย'],
        ['no' => '04', 'name' => 'ฮ่าๆ'],
        ['no' => '05', 'name' => 'ว้าว'],
        ['no' => '06', 'name' => 'เศร้า'],
        ['no' => '07', 'name' => 'โกรธ'],
        ['no' => '00', 'name' => 'Back'],
      )
    );
    return json_decode($menu);
  }

  public function show_menu_mass_comments() {
    $menu = json_encode(
      array(
        ['no' => '01', 'name' => 'คอมเม้นโพสต์เพื่อนทั้งหมด'],
        ['no' => '02', 'name' => 'คอมเม้นคนอื่น'],
        ['no' => '03', 'name' => 'คอมเม้นกลุ่ม'],
        ['no' => '04', 'name' => 'คอมเม้นเพจ'],
        ['no' => '00', 'name' => 'Back'],
      )
    );
    return json_decode($menu);
  }
}