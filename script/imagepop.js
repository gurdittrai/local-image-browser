const ZOOM_SPD = 0.1;
let zoom = 1;

$(document).ready(function () {
    // gallery
    $(".grid").magnificPopup({
        delegate: "a",
        gallery: {
            enabled: true,
            preload: [4, 8]
        },
        type: "image",
        overflowY: "hidden",
        callbacks: {
            open: function () {
                // disable mousewheel on background
                $("body").css("overflow", "hidden");
            },
            imageLoadComplete: function (e) {
                // image properties
                // $("img.mfp-img").css("transform-origin", "top");
                $("img.mfp-img").css("transform", `scale(${zoom})`);
                // mouse position nav for zoom
                $("img.mfp-img").mousemove(function (e) {
                    let bound = e.target.getBoundingClientRect();
                    let mouseX = e.clientX - bound.left;
                    let mouseY = e.clientY - bound.top;
                    let xPercent = (mouseX / bound.width) * 100;
                    let yPercent = (mouseY / bound.height) * 100;
                    $(this).css('transform-origin', (xPercent + '% ' + yPercent + '%'));
                });
                // $("img.mfp-img").mouseover(function (e) {
                //     let bound = e.target.getBoundingClientRect();
                //     let mouseX = e.clientX - bound.left;
                //     let mouseY = e.clientY - bound.top;
                //     let xPercent = (mouseX / bound.width) * 100;
                //     let yPercent = (mouseY / bound.height) * 100;
                //     $(this).css('transform-origin', (xPercent + '% ' + yPercent + '%'));
                // });
                // mousewheel for zoom
                $("img.mfp-img").bind("mousewheel", function (e) {
                    if (e.originalEvent.wheelDelta / 120 > 0) {
                        this.style.transform = `scale(${zoom += ZOOM_SPD})`;
                    } else {
                        if (zoom > 1) {
                            this.style.transform = `scale(${zoom -= ZOOM_SPD})`;
                        }
                    }
                });
            },
            close: function () {
                $("body").css("overflow", "");
            },
        }
    });
});
