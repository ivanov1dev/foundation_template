<?php

/**
 * Class TemplateBuilder.
 */
class TemplateBuilder {

  /**
   * @param string $machine_name
   * @param array $mapping
   * @param string $file_name
   * @return string
   */
  public static function buildFile($machine_name, $mapping, $file_name) {
     return self::build($machine_name, $mapping, $file_name);
  }

  /**
   * @param string $machine_name
   * @param array $mapping
   * @param null|string $file_name
   * @return string
   */
  public static function build($machine_name, $mapping, $file_name = NULL) {
    $options = ['mapping' => $mapping, 'machine_name' => $machine_name];
    $template = TemplateFactory::build($machine_name, $options);
    return $template->build($file_name);
  }
}
