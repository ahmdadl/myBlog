require("./bootstrap-native-v4.min");

const replayBtns = document.querySelectorAll(".showReplayForm");

for (const btn of replayBtns) {
    btn.addEventListener("click", function(ev) {
        for (const repForm of document.querySelectorAll('.replayForm')) {
            if (repForm.className.indexOf('d-none') === -1) {
                repForm.className +=' d-none'
            }
        }

        const form = document.getElementById(
            ev.target.getAttribute("replay-id")
        );

        form.className = form.className.replace('d-none', '').trim()
        // form.getElementsByClassName('form-control').focus()
    });
}
