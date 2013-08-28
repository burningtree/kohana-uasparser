<?php

require_once Kohana::find_file('vendor', 'uasparser/UASparser', 'php');
class UASparserKohana {

  var $parser;

  public function __construct()
  {
    $this->parser = new UASparser;
    $this->parser->SetCacheDir(APPPATH.'cache/uasparser/');
  }
    
  static function factory()
  {
    return new self();
  }

  function parse($useragent, $include_icon_path=TRUE)
  {
    $output = $this->parser->parse($useragent);
    if($include_icon_path)
    {
      $output['os_icon_path'] = URL::site('uasparser/assets/os/'.$output['os_icon'], TRUE);
      $output['ua_icon_path'] = URL::site('uasparser/assets/ua/'.$output['ua_icon'], TRUE);
    }
    return $output;
  }
}
