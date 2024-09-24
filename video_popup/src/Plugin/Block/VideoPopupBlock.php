<?php

namespace Drupal\video_popup\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Provides a 'Video Popup' block.
 * 
 * @Block(
 *   id = "video_popup_block",
 *   admin_label = @Translation("Video Popup Block"),
 * ) 
 */
class VideoPopupBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    // Get the block configuration for the video URL, heading, and description.
    $config = $this->getConfiguration();
  
    return [
      '#theme' => 'video_popup_block',
      '#field_videopopup_heading' => $config['field_videopopup_heading'] ?? '',
      '#field_videopopup_description' => $config['field_videopopup_description'] ?? '',
      '#field_videopopup_video_url' => $config['field_videopopup_video_url'] ?? '',
      '#attached' => [
        'library' => [
          'video_popup/video_popup_library',
        ],
      ],
      '#cache' => [
        'contexts' => ['url.path'],
        'tags' => ['config:block'],
      ],
    ];
  }  

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();

    $form['field_videopopup_heading'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Heading'),
      '#default_value' => $config['field_videopopup_heading'] ?? '',
    ];

    $form['field_videopopup_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#default_value' => $config['field_videopopup_description'] ?? '',
    ];

    $form['field_videopopup_video_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Video URL'),
      '#default_value' => $config['field_videopopup_video_url'] ?? '',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfigurationValue('field_videopopup_heading', $form_state->getValue('field_videopopup_heading'));
    $this->setConfigurationValue('field_videopopup_description', $form_state->getValue('field_videopopup_description'));
    $this->setConfigurationValue('field_videopopup_video_url', $form_state->getValue('field_videopopup_video_url'));
  }
}