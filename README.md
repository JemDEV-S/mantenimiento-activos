# SIGAT — Sistema Integral de Gestión de Activos Tecnológicos

Sistema web desarrollado en Laravel para la administración del ciclo de vida completo de los activos tecnológicos de una municipalidad: inventario, mantenimiento, campañas masivas, documentación y monitoreo.

## Módulos

| Módulo | Descripción |
|--------|-------------|
| **Catálogo institucional** | Sedes, gerencias, oficinas, áreas, técnicos, proveedores, marcas, modelos y catálogos generales |
| **Inventario** | Registro de activos con datos patrimoniales, técnicos, componentes, licencias y archivos adjuntos |
| **Asignaciones y movimientos** | Control de custodia, traslados y generación de cargos de entrega/devolución |
| **Mantenimiento individual** | Solicitudes, órdenes de trabajo, diagnósticos, repuestos, costos, evidencias y conformidades |
| **Campañas de mantenimiento** | Planificación masiva por sede, gerencia u oficina con seguimiento de avance e indicadores |
| **Gestión documental** | Generación automática de fichas técnicas, actas, órdenes e informes en PDF (individual y por lotes) |
| **Reportes y dashboards** | Tableros configurables, reportes operativos/estratégicos y exportación a Excel/PDF |
| **Agente local** | Servicio instalado en PCs que recolecta hardware, software, red y envía heartbeats al sistema |
| **IA opcional** | Asistencia para redacción técnica, resúmenes y consultas en lenguaje natural (no bloquea operación si no está disponible) |
| **Auditoría** | Trazabilidad completa de acciones, cambios, accesos y eventos del sistema |

## Stack tecnológico

- **Backend:** Laravel (PHP 8.2+)
- **Base de datos:** MySQL / PostgreSQL
- **Colas:** Redis + Laravel Horizon
- **Documentos:** PDF generados con Blade + DomPDF/Snappy
- **Agente local:** Go / C# / Python (componente independiente)
- **IA:** Integración desacoplada con proveedor externo de LLM (OpenAI, Anthropic, etc.)

## Arquitectura

```
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│  App Laravel  │◄───►│  Base datos   │     │  LLM externo │
│  (API + Web)  │     └──────────────┘     └──────▲───────┘
│               │◄───► Redis / Colas              │
└──────┬───────┘                           (opcional)
       │
       ▼
┌──────────────┐
│ Agente local │  (instalado en PCs institucionales)
└──────────────┘
```

## Roles principales

Administrador del sistema · Administrador TI · Técnico de soporte · Supervisor de mantenimiento · Responsable de oficina · Usuario consultor · Auditor · Operador documental

## Fases de implementación

1. **MVP:** Usuarios, permisos, inventario, mantenimiento individual, documentos básicos
2. **Operación institucional:** Campañas, reportes, dashboards, documentos consolidados
3. **Automatización:** Agente local, vinculación de dispositivos, alertas técnicas
4. **Asistencia inteligente:** Integración LLM, consultas naturales, redacción asistida

## Principios de diseño

- El sistema opera completamente sin IA; la inteligencia artificial es un complemento opcional.
- Las campañas de mantenimiento son entidades de negocio de primera clase, no solo filtros.
- El agente local es un componente independiente y seguro.
- La auditoría se implementa desde el inicio.
- Los documentos se generan como consecuencia natural de los datos registrados.