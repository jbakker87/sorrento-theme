<?php

/**
 * Theme filters.
 */

namespace App;

// Gravity Forms
add_action('gform_after_save_form', [ new \App\Actions\GravityForms(), 'defaultSettings' ], 10, 2);
