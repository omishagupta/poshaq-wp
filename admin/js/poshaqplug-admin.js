<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
<script>
var clipboard = new Clipboard('.btnn');

clipboard.on('success', function(e) {
    console.info('Accion:', e.action);
    console.info('Texto:', e.text);
    console.info('Trigger:', e.trigger);

    e.clearSelection();
});

clipboard.on('error', function(e) {
    console.error('Accion:', e.action);
    console.error('Trigger:', e.trigger);
});
</script>
