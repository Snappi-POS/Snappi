// Chart module - loaded on demand
export async function initializeCharts() {
    // Dynamically import ApexCharts
    const module = await import('apexcharts');
    const ApexCharts = module.default;
    window.ApexCharts = ApexCharts;
    
    // Add your chart initialization logic here
    console.log('Charts module loaded');
    
    return ApexCharts;
}
