class MobileMenu {
    constructor() {
        this.button = null;
        this.collapseElement = null;
    }

    init() {
        this.button = document.getElementById('collapse') ?? false;

        if (! this.button.hasAttribute('data-target')) {
            return;
        }

        let dataTarget = this.button.getAttribute('data-target');
        this.collapseElement = document.getElementById(dataTarget) ?? false;

        if (! this.collapseElement) {
            return;
        }

        this.onClick = this.onClick.bind(this);
        this.button.addEventListener('click', this.onClick, false);
    }

    onClick(event){
        this.collapseElement.classList.toggle('show');
    }
}

export default MobileMenu;