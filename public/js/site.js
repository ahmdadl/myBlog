// $(".showReplayForm").click(_ => {
//     $(".replayForm").removeClass("d-none");
//     $(".replayForm textarea").focus();
// });

var data = {
    items: ["Bananas", "Apples"],
    title: "My Shopping List"
};

Vue.filter('capt', function (str) {
    if (!str) return '';
    return str.toString().toUpperCase();
});

new Vue({
    el: "#app",
    data: data
});
