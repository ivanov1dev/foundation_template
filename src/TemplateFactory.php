<?php

/**
 * Class TemplateFactory.
 */
class TemplateFactory {

  /**
   * @param string $name
   * @param null $options
   * @return TemplateInterface
   * @throws RuntimeException
   */
  public static function build($name, $options = NULL) {
    $class = FoundationString::className($name);

    foreach ([$class, 'TemplateDefault'] as $template_class) {
      if (class_exists($template_class)) {
        return new $template_class($options);
      }
    }

    throw new RuntimeException("Class template: $class not found!");
  }
}
