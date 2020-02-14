<?php

/**
 * Interface TemplateRepositoryInterface.
 */
interface TemplateRepositoryInterface {

  /**
   * @param string $machine_name
   * @return array|false
   */
  public function getMeta($machine_name);
}
