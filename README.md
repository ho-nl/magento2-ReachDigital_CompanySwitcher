# Magento 2 Ho_CompanySwitcher

[Changelog](CHANGELOG.md)

## Installation
```BASH
composer config repositories.honl/magento2-companyswitcher vcs git@github.com:ho-nl/magento2-Ho_CompanySwitcher.git
composer require honl/magento2-companyswitcher
```

## Description
Moves the Company and Vat field to the top of the checkout and adds a switcher (private/business)

### 'Own Reference' field
Field is added to the order view page automatically. You'll need to edit the matching template when adding the field to email/pdf.

#### Email
For email you can use:
`{{depend order.getData('own_reference')}}<div>{{trans 'Own reference: %own_reference' own_reference=$order.getData('own_reference') |escape|raw}}</div>{{/depend}}`

#### (Fooman) PDF
For PDF you can use:
```PHP
<?php if (! empty($order->getData('own_reference'))): ?>
    <?php echo __('Own reference') ?>: <?php echo $block->escapeHtml($order->getData('own_reference')) ?><br/>
<?php endif; ?>
```
