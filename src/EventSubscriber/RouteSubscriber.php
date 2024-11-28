<?php

declare(strict_types=1);

namespace Drupal\filtered_node_revisions\EventSubscriber;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Route subscriber.
 */
final class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection): void {
    if ($route = $collection->get('node.revision_revert_confirm')) {
      $route->setDefault('_form', '\Drupal\filtered_node_revisions\Form\NodeRevisionRevertForm');
    }

    // Create a new route for Filtered revisions.
    if ($route = $collection->get('entity.node.version_history')) {
      $cloned_route = clone $route;
      $cloned_route->setPath('/node/{node}/revisions/filtered');
      $cloned_route->setDefault('_title', 'Filtered Revisions');
      $collection->add('entity.node.filtered_node_revisions_filtered_version_history', $cloned_route);
    }
  }

}
