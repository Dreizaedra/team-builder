import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['flash'];

    connect() {
        setTimeout(() => {
            this.flashTarget.classList.add('d-none');
        }, 5000);
    }
}
