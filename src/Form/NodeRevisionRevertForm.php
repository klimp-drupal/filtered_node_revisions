<?php

declare(strict_types=1);

namespace Drupal\filtered_node_revisions\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Form\NodeRevisionRevertForm as NodeRevisionRevertCoreForm;
use Drupal\node\NodeInterface;

/**
 * Provides a custom NodeRevisionRevertForm form.
 */
final class NodeRevisionRevertForm extends NodeRevisionRevertCoreForm {

  /**
   * {@inheritdoc}
   */
  protected function prepareRevertedRevision(NodeInterface $revision, FormStateInterface $form_state) {
    // Set revision to Draft.
    // See https://www.drupal.org/project/drupal/issues/3202904#comment-15599026
    if ($revision->hasField('moderation_state')) {
      $revision->set('moderation_state', 'draft');
    }
    return parent::prepareRevertedRevision($revision, $form_state);
  }

}
