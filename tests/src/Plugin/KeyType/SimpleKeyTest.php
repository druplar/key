<?php
/**
 * @file
 * Provides \Drupal\Tests\key\Plugin\KeyType\SimpleKeyTest
 */

namespace Drupal\Tests\key\Plugin\KeyType;

use Drupal\Tests\key\KeyTypeTestBase;

/**
 * Test the SimpleKey plugin.
 */
class SimpleKeyTest extends KeyTypeTestBase {

  const PLUGIN_CLASS = '\Drupal\key\Plugin\KeyType\SimpleKey';
  const PLUGIN_ID = 'key_type_simple';
  const PLUGIN_TITLE = 'Simple Key';
  const PLUGIN_STORAGE = 'config';

  /**
   * Test the plugin configuration form.
   *
   * @group key
   */
  public function testPluginForm() {
    $value = $this->getRandomGenerator()->word(10);
    $form = [];

    $form['key_settings'] = $this->plugin->buildConfigurationForm($form, $this->form_state);
    $this->assertNotNull($form['key_settings']['simple_key_value']);
    $this->assertEmpty($form['key_settings']['simple_key_value']['#default_value']);

    // Set the form state value, and simulate a form submission.
    $this->form_state->setValues(['simple_key_value' => $value]);
    $this->plugin->validateConfigurationForm($form, $this->form_state);
    $this->assertEmpty($this->form_state->getErrors());

    // Submission.
    $this->plugin->submitConfigurationForm($form, $this->form_state);
    $this->assertEquals($value, $this->plugin->getConfiguration()['simple_key_value']);
  }
}