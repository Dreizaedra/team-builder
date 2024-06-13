import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['draggable', 'dropzone']

    connect() {
        this.draggableTargets.forEach(t => {
            t.addEventListener('dragstart', this.handleDragStart.bind(this));
        });

        this.dropzoneTargets.forEach(t => {
            t.addEventListener('dragover', this.handleDragOver.bind(this));
            t.addEventListener('dragenter', this.handleDragEnter.bind(this));
            t.addEventListener('dragleave', this.handleDragLeave.bind(this));
            t.addEventListener('drop', this.handleDrop.bind(this));
        });
    }

    disconnect() {
        super.disconnect();

        this.draggableTargets.forEach(t => {
            t.removeEventListener('dragstart', this.handleDragStart);
        });

        this.dropzoneTargets.forEach(t => {
            t.removeEventListener('dragover', this.handleDragOver);
            t.removeEventListener('dragenter', this.handleDragEnter);
            t.removeEventListener('dragleave', this.handleDragLeave);
            t.removeEventListener('drop', this.handleDrop);
        });
    }

    handleDragStart = ev => {
        ev.dataTransfer.setData('text/plain', ev.target.id);
    }

    handleDragOver = ev => {
        ev.preventDefault();
    }

    handleDragEnter = ev => {
        ev.target.classList.add('drag-over');
    }

    handleDragLeave = ev => {
        ev.target.classList.remove('drag-over');
    }

    handleDrop = ev => {
        ev.preventDefault();

        const draggableElement = document.getElementById(ev.dataTransfer.getData('text/plain'));
        console.log(ev.target);
        ev.target.appendChild(draggableElement);
    }
}
