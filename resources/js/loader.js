// Conditional module loader
window.moduleLoader = {
    loaded: new Set(),
    
    async loadCharts() {
        if (!this.loaded.has('charts')) {
            const { initializeCharts } = await import('./modules/charts.js');
            await initializeCharts();
            this.loaded.add('charts');
        }
    },
    
    async loadAlerts() {
        if (!this.loaded.has('alerts')) {
            const module = await import('sweetalert2');
            window.Swal = module.default;
            this.loaded.add('alerts');
        }
    }
};

// Make alert functions globally available
window.showAlert = async (options) => {
    const { showAlert } = await import('./modules/alerts.js');
    return showAlert(options);
};

window.showSuccess = async (message, title) => {
    const { showSuccess } = await import('./modules/alerts.js');
    return showSuccess(message, title);
};

window.showError = async (message, title) => {
    const { showError } = await import('./modules/alerts.js');
    return showError(message, title);
};

window.showConfirm = async (message, title) => {
    const { showConfirm } = await import('./modules/alerts.js');
    return showConfirm(message, title);
};
