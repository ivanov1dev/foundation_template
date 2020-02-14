<?php

/**
 * Interface TemplateInterface.
 */
interface TemplateInterface {

  /**
   * @param null $filename
   * @return mixed
   */
  public function build($filename = NULL);

  /**
   * @param string $meta
   * @return bool|mixed
   */
  public function get($meta);

  /**
   * @param string $key
   * @param mixed $meta
   * @return $this
   */
  public function set($key, $meta);

}
