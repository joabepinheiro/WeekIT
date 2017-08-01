<?php
return array(
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'partial/form'                                              => __DIR__ . '/../view/partial/form/form.phtml',

            'partial/main-sidebar'                                              => __DIR__ . '/../view/partial/main-sidebar/main-sidebar.phtml',
            'partial/main-header'                                               => __DIR__ . '/../view/partial/main-header/main-header.phtml',
            'partial/main-header/navbar-custom-menu'                            => __DIR__ . '/../view/partial/main-header/navbar-custom-menu/navbar-custom-menu.phtml',
            'partial/main-header/navbar-custom-menu/messages-menu'              => __DIR__ . '/../view/partial/main-header/navbar-custom-menu/messages-menu/messages-menu.phtml',
            'partial/main-header/navbar-custom-menu/notifications-menu'         => __DIR__ . '/../view/partial/main-header/navbar-custom-menu/notifications-menu/notifications-menu.phtml',
            'partial/main-header/navbar-custom-menu/tasks-menu'                 => __DIR__ . '/../view/partial/main-header/navbar-custom-menu/tasks-menu/tasks-menu.phtml',
            'partial/main-header/navbar-custom-menu/user-menu'                  => __DIR__ . '/../view/partial/main-header/navbar-custom-menu/user-menu/user-menu.phtml',
            'partial/main-header/navbar-custom-menu/control-sidebar'            => __DIR__ . '/../view/partial/main-header/navbar-custom-menu/control-sidebar/control-sidebar.phtml',
            'partial/control-sidebar'                                           => __DIR__ . '/../view/partial/control-sidebar/control-sidebar.phtml',
            'mails/suporte'                                                     => __DIR__ . '/../view/mails/suporte.phtml',

            //Form
            'partial/form/general/quick'                              => __DIR__ . '/../view/partial/form/general/quick/form.phtml',
            'partial/form/general/quick/element/element'                              => __DIR__ . '/../view/partial/form/general/quick/element/element.phtml',
            'partial/form/general/quick/element/email'                              => __DIR__ . '/../view/partial/form/general/quick/element/email.phtml',
            'partial/form/general/quick/element/file'                               => __DIR__ . '/../view/partial/form/general/quick/element/file.phtml',
            'partial/form/general/quick/element/password'                           => __DIR__ . '/../view/partial/form/general/quick/element/password.phtml',
            'partial/form/general/quick/element/text'                               => __DIR__ . '/../view/partial/form/general/quick/element/text.phtml',
            'partial/form/general/quick/element/radio'                               => __DIR__ . '/../view/partial/form/general/quick/element/radio.phtml',
            'partial/form/general/quick/element/checkbox'                               => __DIR__ . '/../view/partial/form/general/quick/element/checkbox.phtml',
            'partial/form/general/quick/element/select'                               => __DIR__ . '/../view/partial/form/general/quick/element/select.phtml',
            'partial/form/general/quick/element/select-multiple'                               => __DIR__ . '/../view/partial/form/general/quick/element/select-multiple.phtml',
            'partial/form/general/quick/element/textarea'                               => __DIR__ . '/../view/partial/form/general/quick/element/textarea.phtml',
            'partial/form/general/quick/element/hidden'                               => __DIR__ . '/../view/partial/form/general/quick/element/hidden.phtml',

            'partial/form/general/quick/message-erros'                               => __DIR__ . '/../view/partial/form/general/quick/message-erros.phtml',
            'partial/form/paginator'                               => __DIR__ . '/../view/partial/paginator/paginator.phtml',
            'partial/messages'                               => __DIR__ . '/../view/partial/messages/messages.phtml',
            'partial/deletar'                               => __DIR__ . '/../view/partial/deletar.phtml',
            'partial/breadcrumb'                               => __DIR__ . '/../view/partial/breadcrumb/breadcrumb.phtml',


        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        )
    ),

);