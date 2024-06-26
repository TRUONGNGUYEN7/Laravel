/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here.
    // For complete reference see:
    // https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

    // Thêm plugin "Paste from Word"
    config.allowedContent = true; // Hoặc bạn có thể cấu hình theo nhu cầu của bạn.

    config.extraPlugins = 'pastefromword,imageuploader';

    config.extraPlugins += (config.extraPlugins ? ',' : '') + 'video';
    
    config.toolbarGroups.push({ name: 'insert', groups: ['image'] });
    config.imageUploadUrl = '/fileUpload'; // Đường dẫn để tải lên hình ảnh
    config.imageUploadParams = { '_token': '{{ csrf_token() }}' }; // Tham số yêu cầu khi tải lên hình ảnh
    config.imageUploadMaxSize = 1024 * 1024 * 2; // Kích thước tệp tối đa (đơn vị byte)

    // The toolbar groups arrangement, optimized for two toolbar rows.
    config.toolbarGroups = [
        { name: 'clipboard', groups: ['clipboard', 'undo'] },
        { name: 'editing', groups: ['find', 'selection', 'spellchecker'] },
        { name: 'links' },
        { name: 'insert' },
        { name: 'forms' },
        { name: 'tools' },
        { name: 'document', groups: ['mode', 'document', 'doctools'] },
        { name: 'others' },
        '/',
        { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
        { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'] },
        { name: 'styles' },
        { name: 'colors' },
        { name: 'about' }
    ];
    config.video = {
        // Your custom video options go here
        // For example:
        providers: [
            {
                name: 'YouTube',
                url: /^https:\/\/(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)([^"&?\/\s]{11})/,
                html: '<iframe width="200" height="210" src="https://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
            }
        ]
    };
    // Remove some buttons provided by the standard plugins, which are
    // not needed in the Standard(s) toolbar.
    config.removeButtons = 'Underline,Subscript,Superscript';

    // Set the most common block elements.
    config.format_tags = 'p;h1;h2;h3;pre';

    // Simplify the dialog windows.
    config.removeDialogTabs = 'image:advanced;link:advanced';


};