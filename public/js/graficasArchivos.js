function cambiar_fecha_grafica(){
    var anio_sel=$("#anio_sel").val();
    var mes_sel=$("#mes_sel").val();

    grafica_visitas_archivos(anio_sel,mes_sel);
    grafica_descargas_archivos(anio_sel,mes_sel);
    grafica_top_visitas_libros(anio_sel,mes_sel);
    grafica_top_visitas_revistas(anio_sel,mes_sel);
    grafica_top_descargas_libros(anio_sel,mes_sel);
    grafica_top_descargas_revistas(anio_sel,mes_sel);
}



function grafica_visitas_archivos(anio,mes){

    var options={
        chart: {
            renderTo: 'div_grafica_visitas_archivos',
            type: 'column'
        },
        title: {
            text: 'Numero De Visitas En El Mes'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [],
            title: {
                text: 'DIAS DEL MES'
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'VISITAS AL DIA'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'libros',
            color: '#c50083',
            data: []

        },{
            name: 'revistas',
            color: '#811a5f',
            data: []

        }]
    }

    var URLactual = window.location;
    var url = URLactual+"/grafica_visitas/"+anio+"/"+mes+"";
    
    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);

    if(mes==0){
        options.xAxis.title.text="MESES DEL AÑO";
        options.yAxis.title.text="VISITAS AL MES";
        options.title.text="Numero De Visitas Por Año";
    }
    var totaldias=datos.totaldias;
    var registrosLibros=datos.registrosLibros;
    var registrosRevistas=datos.registrosRevistas;
    var i=0;
    for(i=1;i<=totaldias;i++){
    options.series[0].data.push( registrosLibros[i] );
    options.series[1].data.push( registrosRevistas[i] );
    options.xAxis.categories.push(i);
    }

    chart = new Highcharts.Chart(options);

    })

}


function grafica_descargas_archivos(anio,mes){

    var options={
        chart: {
            renderTo: 'div_grafica_descargas_archivos',
            type: 'column'
        },
        title: {
            text: 'Numero De Descargas En El Mes'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [],
            title: {
                text: 'DIAS DEL MES'
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'DESCARGAS AL DIA'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'libros',
            color: '#c50083',
            data: []

        },{
            name: 'revistas',
            color: '#811a5f',
            data: []

        }]
    }

    var URLactual = window.location;
    var url = URLactual+"/grafica_descargas/"+anio+"/"+mes+"";
    
    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);

    if(mes==0){
        options.xAxis.title.text="MESES DEL AÑO";
        options.yAxis.title.text="DESCARGAS AL MES";
        options.title.text="Numero De Descargas Por Año";
    }
    var totaldias=datos.totaldias;
    var registrosLibros=datos.registrosLibros;
    var registrosRevistas=datos.registrosRevistas;
    var i=0;
    for(i=1;i<=totaldias;i++){
    options.series[0].data.push( registrosLibros[i] );
    options.series[1].data.push( registrosRevistas[i] );
    options.xAxis.categories.push(i);
    }

    chart = new Highcharts.Chart(options);

    })
}

function  grafica_top_visitas_libros(anio,mes){

    var options={
        chart: {
            renderTo: 'div_grafica_top_visitas_libros',
            type: 'column'
        },
        title: {
            text: 'Top 5 Visitas Libros En El Mes'
        },
        subtitle: {
            text: ''
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: [],
            crosshair: true,
            title: {
                text: 'LIBROS'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'VISTAS AL MES'
            }
    
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
    
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
           
        },
    
        series: [
            {
                name: "Libro",
                colorByPoint: true,
                data: [
                    {
                        name: "1",
                        color: '#c50083',
                        y: 0,
                        drilldown: "1"
                    },
                    {
                        name: "2",
                        color: '#811a5f',
                        y: 0,
                        drilldown: "2"
                    },
                    {
                        name: "3",
                        color: '#c50083',
                        y: 0,
                        drilldown: "3"
                    },
                    {
                        name: "4",
                        color: '#811a5f',
                        y: 0,
                        drilldown: "4"
                    }
                    ,
                    {
                        name: "5",
                        color: '#c50083',
                        y: 0,
                        drilldown: "5"
                    }
                ]
            }
        ],
        drilldown: {
            series: [
                {
                    name: "1",
                    id: "1",
                    data: []
                },
                {
                    name: "2",
                    id: "2",
                    data: []
                },
                {
                    name: "3",
                    id: "3",
                    data: []
                },
                {
                    name: "4",
                    id: "4",
                    data: []
                }
                ,
                {
                    name: "5",
                    id: "5",
                    data: []
                }
            ]
        }
    };

    var URLactual = window.location;
    var url = URLactual+"/grafica_visitas_top_libros/"+anio+"/"+mes+"";
    
    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);

    if(mes==0){
        options.yAxis.title.text="VISTAS AL AÑO";
        options.title.text="Top 5 Visitas Libros En El Año";
    }
    var i=0;
    var cantLibros=Object.keys(datos).length;
  
    for(i=1;i<=cantLibros;i++){
        
        options.series[0].data[i-1].name = datos[i-1].nombre;
        options.series[0].data[i-1].drilldown=datos[i-1].nombre;
        options.series[0].data[i-1].y= datos[i-1].cant_visitas;
        options.drilldown.series[i-1].name=datos[i-1].nombre ;
        options.drilldown.series[i-1].id=datos[i-1].nombre ;
        options.drilldown.series[i-1].data.push( datos[i-1].cant_visitas );
        
        options.xAxis.categories.push(i);
    }
    

    chart = new Highcharts.chart(options); 
    })
}

function   grafica_top_visitas_revistas(anio,mes){

    var options={
        chart: {
            renderTo: 'div_grafica_top_visitas_revistas',
            type: 'column'
        },
        title: {
            text: 'Top 5 Visitas Revistas En El Mes'
        },
        subtitle: {
            text: ''
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: [],
            crosshair: true,
            title: {
                text: 'REVISTAS'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'VISTAS AL MES'
            }
    
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
    
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
           
        },
    
        series: [
            {
                name: "Revista",
                colorByPoint: true,
                data: [
                    {
                        name: "1",
                        color: '#c50083',
                        y: 0,
                        drilldown: "1"
                    },
                    {
                        name: "2",
                        color: '#811a5f',
                        y: 0,
                        drilldown: "2"
                    },
                    {
                        name: "3",
                        color: '#c50083',
                        y: 0,
                        drilldown: "3"
                    },
                    {
                        name: "4",
                        color: '#811a5f',
                        y: 0,
                        drilldown: "4"
                    }
                    ,
                    {
                        name: "5",
                        color: '#c50083',
                        y: 0,
                        drilldown: "5"
                    }
                ]
            }
        ],
        drilldown: {
            series: [
                {
                    name: "1",
                    id: "1",
                    data: []
                },
                {
                    name: "2",
                    id: "2",
                    data: []
                },
                {
                    name: "3",
                    id: "3",
                    data: []
                },
                {
                    name: "4",
                    id: "4",
                    data: []
                }
                ,
                {
                    name: "5",
                    id: "5",
                    data: []
                }
            ]
        }
    };

    var URLactual = window.location;
    var url = URLactual+"/grafica_visitas_top_revistas/"+anio+"/"+mes+"";
    
    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);

    if(mes==0){
        options.yAxis.title.text="VISTAS AL AÑO";
        options.title.text="Numero De Vistas Por Año";
    }
    var i=0;
    var cantRevistas=Object.keys(datos).length;
  
    for(i=1;i<=cantRevistas;i++){
        
        options.series[0].data[i-1].name = datos[i-1].nombre;
        options.series[0].data[i-1].drilldown=datos[i-1].nombre;
        options.series[0].data[i-1].y= datos[i-1].cant_visitas;
        options.drilldown.series[i-1].name=datos[i-1].nombre ;
        options.drilldown.series[i-1].id=datos[i-1].nombre ;
        options.drilldown.series[i-1].data.push( datos[i-1].cant_visitas );
        
        options.xAxis.categories.push(i);
    }
    

    chart = new Highcharts.chart(options); 
    })
}

function   grafica_top_descargas_libros(anio,mes){
    var options={
        chart: {
            renderTo: 'div_grafica_top_descargas_libros',
            type: 'column'
        },
        title: {
            text: 'Top 5 Descargas Libros En El Mes'
        },
        subtitle: {
            text: ''
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: [],
            crosshair: true,
            title: {
                text: 'LIBROS'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'DESCARGAS AL MES'
            }
    
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
    
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
           
        },
    
        series: [
            {
                name: "Libro",
                colorByPoint: true,
                data: [
                    {
                        name: "1",
                        color: '#c50083',
                        y: 0,
                        drilldown: "1"
                    },
                    {
                        name: "2",
                        color: '#811a5f',
                        y: 0,
                        drilldown: "2"
                    },
                    {
                        name: "3",
                        color: '#c50083',
                        y: 0,
                        drilldown: "3"
                    },
                    {
                        name: "4",
                        color: '#811a5f',
                        y: 0,
                        drilldown: "4"
                    }
                    ,
                    {
                        name: "5",
                        color: '#c50083',
                        y: 0,
                        drilldown: "5"
                    }
                ]
            }
        ],
        drilldown: {
            series: [
                {
                    name: "1",
                    id: "1",
                    data: []
                },
                {
                    name: "2",
                    id: "2",
                    data: []
                },
                {
                    name: "3",
                    id: "3",
                    data: []
                },
                {
                    name: "4",
                    id: "4",
                    data: []
                }
                ,
                {
                    name: "5",
                    id: "5",
                    data: []
                }
            ]
        }
    };

    var URLactual = window.location;
    var url = URLactual+"/grafica_descargas_top_libros/"+anio+"/"+mes+"";
    
    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);

    if(mes==0){
        options.yAxis.title.text="DESCARGAS AL AÑO";
        options.title.text="Top 5 Descargas Libros En El Año";
    }
    var i=0;
    var cantLibros=Object.keys(datos).length;
  
    for(i=1;i<=cantLibros;i++){
        
        options.series[0].data[i-1].name = datos[i-1].nombre;
        options.series[0].data[i-1].drilldown=datos[i-1].nombre;
        options.series[0].data[i-1].y= datos[i-1].cant_visitas;
        options.drilldown.series[i-1].name=datos[i-1].nombre ;
        options.drilldown.series[i-1].id=datos[i-1].nombre ;
        options.drilldown.series[i-1].data.push( datos[i-1].cant_visitas );
        
        options.xAxis.categories.push(i);
    }
    

    chart = new Highcharts.chart(options); 
    })
}

function  grafica_top_descargas_revistas(anio,mes){
    var options={
        chart: {
            renderTo: 'div_grafica_top_descargas_revistas',
            type: 'column'
        },
        title: {
            text: 'Top 5 Descargas Revistas En El Mes'
        },
        subtitle: {
            text: ''
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: [],
            crosshair: true,
            title: {
                text: 'REVISTAS'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'DESCARGAS AL MES'
            }
    
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
    
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
           
        },
    
        series: [
            {
                name: "Revista",
                colorByPoint: true,
                data: [
                    {
                        name: "1",
                        color: '#c50083',
                        y: 0,
                        drilldown: "1"
                    },
                    {
                        name: "2",
                        color: '#811a5f',
                        y: 0,
                        drilldown: "2"
                    },
                    {
                        name: "3",
                        color: '#c50083',
                        y: 0,
                        drilldown: "3"
                    },
                    {
                        name: "4",
                        color: '#811a5f',
                        y: 0,
                        drilldown: "4"
                    }
                    ,
                    {
                        name: "5",
                        color: '#c50083',
                        y: 0,
                        drilldown: "5"
                    }
                ]
            }
        ],
        drilldown: {
            series: [
                {
                    name: "1",
                    id: "1",
                    data: []
                },
                {
                    name: "2",
                    id: "2",
                    data: []
                },
                {
                    name: "3",
                    id: "3",
                    data: []
                },
                {
                    name: "4",
                    id: "4",
                    data: []
                }
                ,
                {
                    name: "5",
                    id: "5",
                    data: []
                }
            ]
        }
    };

    var URLactual = window.location;
    var url = URLactual+"/grafica_descargas_top_revistas/"+anio+"/"+mes+"";
    
    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);

    if(mes==0){
        options.yAxis.title.text="DESCARGAS AL AÑO";
        options.title.text="Numero De Descargas Por Año";
    }
    var i=0;
    var cantRevistas=Object.keys(datos).length;
  
    for(i=1;i<=cantRevistas;i++){
        
        options.series[0].data[i-1].name = datos[i-1].nombre;
        options.series[0].data[i-1].drilldown=datos[i-1].nombre;
        options.series[0].data[i-1].y= datos[i-1].cant_visitas;
        options.drilldown.series[i-1].name=datos[i-1].nombre ;
        options.drilldown.series[i-1].id=datos[i-1].nombre ;
        options.drilldown.series[i-1].data.push( datos[i-1].cant_visitas );
        
        options.xAxis.categories.push(i);
    }
    

    chart = new Highcharts.chart(options); 
    })
}
