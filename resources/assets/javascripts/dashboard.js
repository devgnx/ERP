;(function ( $, window, document, undefined ) {

  $('#sale-sale-chart').highcharts({
    chart: {
      type: "column",
      width: $('#sale-sale-chart').width()
    },
    title: {
      text: "Vendas"
    },
    xAxis: {
      categories: window.dashboardData.sale.categories,
    },
    legend: {
      lineHeight: 20
    },
    yAxis: {
      min: 0,
      allowDecimals: false,
      title: {
        text: "Quantidade"
      }
    },
    plotOptions: {
      line: {
        lineWidth: 2,
        marker: {
          enabled: false
        },
        states: {
          hover: {
            lineWidth: 2
          }
        }
      }
    },
    //colors: ["#25b799", "#d75452 ", "#428bca"],
    credits: {
      enabled: false
    },
    series: window.dashboardData.sale.series,
    legend: {
      lineHeight: 20
    },
    tooltip: {
      crosshairs: true,
      useHTML: true
    }
  });

  $('#sale-product-chart').highcharts({
    chart: {
      type: "column",
      width: $('#sale-product-chart').width()
    },
    title: {
      text: "Produtos"
    },
    xAxis: {
      categories: window.dashboardData.product.categories,
    },
    yAxis: {
      min: 0,
      allowDecimals: false,
      title: {
        text: "Quantidade"
      }
    },
    plotOptions: {
      line: {
        lineWidth: 2,
        marker: {
          enabled: false
        },
        states: {
          hover: {
            lineWidth: 2
          }
        }
      }
    },
    //colors: ["#25b799", "#d75452 ", "#428bca"],
    credits: {
      enabled: false
    },
    series: window.dashboardData.product.series,
    legend: {
      lineHeight: 20
    },
    tooltip: {
      crosshairs: true,
      useHTML: true
    }
  });

  $('#sale-category-chart').highcharts({
    chart: {
      type: "column",
      width: $('#sale-product-chart').width()
    },
    title: {
      text: "Categorias"
    },
    xAxis: {
      categories: window.dashboardData.category.categories,
    },
    yAxis: {
      min: 0,
      allowDecimals: false,
      title: {
        text: "Quantidade"
      }
    },
    plotOptions: {
      line: {
        lineWidth: 2,
        marker: {
          enabled: false
        },
        states: {
          hover: {
            lineWidth: 2
          }
        }
      }
    },
    //colors: ["#25b799", "#d75452 ", "#428bca"],
    credits: {
      enabled: false
    },
    series: window.dashboardData.category.series,
    legend: {
      lineHeight: 20
    },
    tooltip: {
      crosshairs: true,
      useHTML: true
    }
  });


  $('#sale-seller-chart').highcharts({
    chart: {
      type: "column",
      width: $('#sale-product-chart').width()
    },
    title: {
      text: "Vendedores"
    },
    xAxis: {
      categories: window.dashboardData.seller.categories
    },
    yAxis: {
      min: 0,
      title: {
        text: "Quantidade"
      }
    },
    plotOptions: {
    },
    colors: ["#25b799", "#d75452 ", "#428bca"],
    credits: {
      enabled: false
    },
    series: window.dashboardData.seller.series
  });

  $('#sale-customer-chart').highcharts({
    chart: {
      type: "column",
      width: $('#sale-product-chart').width()
    },
    title: {
      text: "Clientes"
    },
    xAxis: {
      categories: window.dashboardData.customer.categories
    },
    yAxis: {
      min: 0,
      title: {
        text: "Quantidade"
      }
    },
    plotOptions: {
    },
    colors: ["#25b799", "#d75452 ", "#428bca"],
    credits: {
      enabled: false
    },
    series: window.dashboardData.customer.series
  });
})( jQuery, window, document );