<?php

namespace Drupal\custom_formatter\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'text_default' formatter.
 *
 * @FieldFormatter(
 *   id = "bold_text",
 *   label = @Translation("Bold Text"),
 *   field_types = {
 *     "string"
 *   }
 * )
 */
class TextBoldFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    // The ProcessedText element already handles cache context & tag bubbling.
    // @see \Drupal\filter\Element\ProcessedText::preRenderText()
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
      '#markup' => "<b>$item->value</b>",
      ];
    }

    return $elements;
  }

}
