<?php

/**
 * Class TemplateDefault.
 */
class TemplateDefault implements TemplateInterface {

  private $meta;
  private $repository;

  /**
   * TemplateDefault constructor.
   * @param null $options
   * @param string $repository
   */
  public function __construct($options = NULL, $repository = 'TemplateRepository') {

    if (!$repository instanceof TemplateRepositoryInterface) {
      $this->repository = new $repository();
    }
    else {
      $this->repository = $repository;
    }

    if (!empty($options)) {
      $meta = $this->repository->getMeta($options['machine_name']);
      $this->meta = array_merge($meta, $options);
    }
  }

  /**
   * @param null $filename
   * @return mixed
   */
  public function build($filename = NULL) {
    libraries_load('phpdocx');

    $template = $this->get('uri');
    $extension = pathinfo($template, PATHINFO_EXTENSION);

    $docx = new CreateDocxFromTemplate($template);

    $mapping = [];
    array_walk($this->get('mapping'), function ($v, $k) use(&$mapping) {
      $mapping[strtoupper($k)] = $v;
    });

    $docx->replaceVariableByText($mapping);

    if ($filename) {
      $filename = substr($filename, 0, strlen($extension) + 1);
      $docx->createDocx($filename);
      return $filename .'.'. $extension;
    }
    else {
      return $docx->createDocxContent();
    }
  }

  /**
   * @param string $meta
   * @return bool|mixed
   */
  public function get($meta) {
    return isset($this->meta[$meta]) ? $this->meta[$meta] : FALSE;
  }

  /**
   * @param string $key
   * @param mixed $meta
   * @return $this
   */
  public function set($key, $meta) {
    $this->meta[$key] = $meta;
    return $this;
  }

}
