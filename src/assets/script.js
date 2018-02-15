function openJoditFileBrowser(element, currentPath) {
    var dialog = new Jodit.modules.FileBrowser(null, Jodit.defaultOptions.filebrowser);
    dialog.currentPath = currentPath;
    dialog.open(function (data) {
        element.classList.remove('jodit-icon-picker_wrong')
        element.querySelector('input').value = data.files[0];
        var image = element.querySelector('img');
        image.style.display = 'inline-block';
        image.src = data.baseurl + data.files[0];
    });
}