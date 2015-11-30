/*!
 * FileInput <_LANG_> Translations
 *
 * This file must be loaded after 'fileinput.js'. Patterns in braces '{}', or
 * any HTML markup tags in the messages must not be converted or translated.
 *
 * @see http://github.com/kartik-v/bootstrap-fileinput
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 */
(function ($) {
    "use strict";

    $.fn.fileinputLocales['ch'] = {
        fileSingle: '文件',
        filePlural: '多樣文件',
        browseLabel: '選擇 &hellip;',
        removeLabel: '移除',
        removeTitle: '清除已選的文件',
        cancelLabel: '取消',
        cancelTitle: '取消進行中的上傳',
        uploadLabel: '上傳',
        uploadTitle: '上傳已選的文件',
        msgSizeTooLarge: '文件 "{name}" (<b>{size} KB</b>) 超過了檔案的最高限額 <b>{maxSize} KB</b>. 請重新上傳!',
        msgFilesTooLess: '你選擇的檔案少過了 <b>{n}</b> {files}. 請重新上傳!',
        msgFilesTooMany: '選擇的上傳文件 <b>({n})</b> 超過了可容許的上限  <b>{m}</b>. 請重新上傳',
        msgFileNotFound: '文件 "{name}" 未找到!',
        msgFileSecured: '安全限制，禁止讀取文件 "{name}".',
        msgFileNotReadable: '文件 "{name}" 不可讀.',
        msgFilePreviewAborted: '預覽暫時不能提供 "{name}".',
        msgFilePreviewError: '讀取 "{name}" 時出現了一個錯誤.',
        msgInvalidFileType: '類型不正確 "{name}". 只支援 "{types}" files are supported.',
        msgInvalidFileExtension: '不正確的文件類型 "{name}". 只支援 "{extensions}" 的文件擴類型.',
        msgValidationError: '文件上傳出錯誤',
        msgLoading: '上傳中 {index} 之 {files} &hellip;',
        msgProgress: '上傳中 {index} 之 {files} - {name} - {percent}% 已上傳.',
        msgSelected: '{n} {files} 已選擇',
        msgFoldersNotAllowed: '只支援拖放文件! 跳過{n} 拖拽的文件夾.',
        dropZoneTitle: '拖放文件到這裡'
    };
})(window.jQuery);