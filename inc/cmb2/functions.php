<?php
add_action('cmb2_admin_init', 'cmb2_metaboxes');

function cmb2_metaboxes()
{
    $cmb = new_cmb2_box(array(
        'id' => 'first_metabox',
        'title' => 'Package Details',
        'object_types' => array('plans'),
        'context' =>  'normal',
        'priority' => 'high',
        'show_names' => true,

    ));

    $cmb->add_field(array(
        'name'             => 'Billing Period',
        'desc'             => 'Select an option',
        'id'               => 'billing_period',
        'type'             => 'select',
        'show_option_none' => true,
        'default'          => 'custom',
        'options'          => array(
            'day' => __('Day', 'cmb2'),
            'month'   => __('Month', 'cmb2'),
            'year'     => __('Year', 'cmb2'),
        ),
    ));

    $cmb->add_field(array(
        'name' => __('Billing Frequency', 'theme-domain'),
        'desc' => __('Numbers only', 'msft-newscenter'),
        'id'   => 'billing_frequency',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
        ),
        'sanitization_cb' => 'absint',
        'escape_cb'       => 'absint',
    ));
    $cmb->add_field(array(
        'name' => __('How many contacts are included?', 'theme-domain'),
        'desc' => __('Numbers only', 'msft-newscenter'),
        'id'   => 'contact_number',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
        ),
        'sanitization_cb' => 'absint',
        'escape_cb'       => 'absint',
    ));

    $cmb->add_field(array(
        'name' => __('How many feature contacts are included?', 'theme-domain'),
        'desc' => __('Numbers only', 'msft-newscenter'),
        'id'   => 'featured_contacts',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
        ),
        'sanitization_cb' => 'absint',
        'escape_cb'       => 'absint',
    ));


    $cmb->add_field(array(
        'name' => 'Unlimited Contacts',
        'desc' => 'Unlimited Contacts',
        'id'   => 'unlimited_contacts_checkbox',
        'type' => 'checkbox',
    ));



    $cmb->add_field(array(
        'name'             => 'Is it visible?',
        'desc'             => 'Select an option',
        'id'               => 'visibility',
        'type'             => 'select',
        'show_option_none' => true,
        'default'          => 'custom',
        'options'          => array(
            'yes' => __('Yes', 'cmb2'),
            'no'   => __('No', 'cmb2'),
        ),
    ));
    $cmb->add_field(array(
        'name' => __('Taxes', 'theme-domain'),
        'desc' => __('Enter the tax percentage(Only digits)', 'msft-newscenter'),
        'id'   => 'number',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
        ),
        'sanitization_cb' => 'absint',
        'escape_cb'       => 'absint',
    ));

    $cmb->add_field(array(
        'name' => __('Package price', 'theme-domain'),
        'desc' => __('Enter the price', 'msft-newscenter'),
        'id'   => 'package_price',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
        ),
        'sanitization_cb' => 'absint',
        'escape_cb'       => 'absint',
    ));
}
