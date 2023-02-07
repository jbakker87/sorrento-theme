<?php

namespace App\Actions;

class GravityForms
{
    public function defaultSettings(array $form, bool $isNew): void
    {
        $form = $this->enableHoneypotOnFormSave($form);
        $form = $this->setRetainEntriesDays($form);
        $form = $this->preventIPSaving($form);
        $form = $this->setActive($form);

        \GFAPI::update_form($form);
    }

    /**
     * Determine if form is active by form meta.
     * Without passing the is_active flag the form will be set to inactive by GF.
     */
    protected function setActive(array $form): array
    {
        if (! class_exists('GFAPI')) {
            $form['is_active'] = '1'; // Defaults to active, you don't want to deactivate activated forms.

            return $form;
        }

        $formMeta          = \GFAPI::get_form($form['id']);
        $isActive          = $formMeta['is_active'] ?? '1'; // Defaults to active, you don't want to deactivate activated forms.
        $status            = '1' === $isActive ? '1' : '0';
        $form['is_active'] = $status;

        return $form;
    }

    /**
     * Honeypot enabled by default.
     */
    protected function enableHoneypotOnFormSave(array $form): array
    {
        $honeyPotEnabled = $form['enableHoneypot'] ?? false;

        if ($honeyPotEnabled) {
            return $form;
        }
        
        $form['enableHoneypot'] = true;
        
        return $form;
    }

    /**
     * Retain entries days limitation.
     */
    protected function setRetainEntriesDays(array $form): array
    {
        $retainEntriesDays      = $form['personalData']['retention']['retain_entries_days'] ?? false;
        $limitEntriesDaysPolicy = $form['personalData']['retention']['policy'] ?? false;

        if (is_numeric($retainEntriesDays) && is_string($limitEntriesDaysPolicy)) {
            return $form;
        }

        $form['personalData']['retention']['retain_entries_days'] = env('GF_RETAIN_ENTRIES_DAYS', 10);
        $form['personalData']['retention']['policy']              = 'delete';

        return $form;
    }

    /**
     * Prevent IP to be saved.
     */
    protected function preventIPSaving(array $form): array
    {
        $isIpAddressPrevented = $form['personalData']['preventIP'] ?? false;

        if ($isIpAddressPrevented) {
            return $form;
        }

        $form['personalData']['preventIP'] = true;

        return $form;
    }

    /**
     * Temporary solution.
     * Fixes the GF merge tags.
     */
    public function fixMergeTags()
    {
        if (empty($_GET['subview']) || $_GET['subview'] !== 'notification') {
            return;
        } ?>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const eventSelect = document.querySelectorAll('[name="_gform_setting_event"');
    
            if (!eventSelect.length) {
                return;
            }
    
            eventSelect[0].setAttribute('id', 'event');
        });
    </script>
    <?php
    }
}
