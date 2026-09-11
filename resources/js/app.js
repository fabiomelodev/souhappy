import SignaturePad from 'signature_pad';

document.addEventListener('alpine:init', () => {
    window.Alpine.data('signaturePad', () => ({
        pad: null,
        isEmpty: true,

        init() {
            const canvas = this.$refs.canvas;
            this.resize(canvas);
            this.pad = new SignaturePad(canvas, { backgroundColor: 'rgb(255, 255, 255)' });
            this.pad.addEventListener('endStroke', () => {
                this.isEmpty = this.pad.isEmpty();
            });

            const onResize = () => this.resize(canvas);
            window.addEventListener('resize', onResize);
        },

        resize(canvas) {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext('2d').scale(ratio, ratio);
            this.pad?.clear();
            this.isEmpty = true;
        },

        clear() {
            this.pad.clear();
            this.isEmpty = true;
        },

        confirm() {
            if (this.pad.isEmpty()) {
                this.isEmpty = true;
                return;
            }

            this.$wire.sign(this.pad.toDataURL('image/png'));
        },
    }));
});
