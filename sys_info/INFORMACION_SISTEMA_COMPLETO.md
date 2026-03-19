# Plan detallado para la creación del Sistema Integral de Gestión de Activos Tecnológicos (SIGAT) para una Municipalidad

## 1. Resumen ejecutivo

Se propone desarrollar un sistema integral en Laravel para gestionar el inventario de activos tecnológicos de una municipalidad, su historial técnico, los mantenimientos individuales y masivos, la generación de documentos, los reportes operativos y estratégicos, la captura automatizada de información desde equipos mediante un agente local y la integración opcional con un servicio externo de LLM.

El sistema debe funcionar completamente sin depender del LLM. La inteligencia artificial será un componente complementario para asistencia, redacción, análisis y consulta avanzada, pero nunca un requisito para la operación principal.

---

## 2. Objetivo general

Diseñar e implementar un sistema centralizado que permita administrar los activos tecnológicos de la municipalidad durante todo su ciclo de vida, controlar los mantenimientos realizados, planificar campañas de mantenimiento a gran escala, generar documentación formal y obtener reportes confiables para la toma de decisiones.

---

## 3. Objetivos específicos

* Registrar todos los activos tecnológicos de la municipalidad con sus datos técnicos, administrativos y operativos.
* Mantener trazabilidad completa del historial de cada activo.
* Registrar mantenimientos preventivos, correctivos, diagnósticos y atenciones de emergencia.
* Planificar y ejecutar campañas de mantenimiento que involucren múltiples activos por sede, área o toda la municipalidad.
* Generar documentos automáticos como actas, fichas técnicas, constancias, órdenes de trabajo y resúmenes masivos.
* Visualizar dashboards y reportes por área, responsable, técnico, tipo de activo y periodo.
* Recibir información técnica real de equipos mediante un agente local instalado en PCs institucionales.
* Integrar un servicio externo de LLM para consultas en lenguaje natural, apoyo en redacción técnica y análisis, sin comprometer la operación manual del sistema.

---

## 4. Alcance funcional

El sistema abarcará los siguientes componentes:

1. Núcleo e infraestructura compartida (documentos, reportes, notificaciones).
2. Autenticación, roles y permisos.
3. Estructura organizacional.
4. Personal: empleados, técnicos y proveedores.
5. Inventario de activos tecnológicos con catálogos propios.
6. Asignación y movimientos de activos.
7. Gestión de mantenimiento individual con catálogos propios.
8. Gestión de campañas de mantenimiento masivo.
9. Agente local para recolección de datos de PCs.
10. Integración opcional con LLM externo.
11. Auditoría y trazabilidad.
12. Configuración general del sistema.

---

## 5. Tipos de activos a considerar

El sistema debe permitir registrar, como mínimo:

* Computadoras de escritorio
* Laptops
* Impresoras
* Escáneres
* UPS
* Monitores
* Servidores
* Switches
* Routers
* Puntos de acceso
* Teléfonos IP
* Cámaras de videovigilancia
* Proyectores
* Tablets
* Equipos biométricos
* Periféricos relevantes
* Componentes internos importantes
* Licencias de software vinculadas al activo

---

## 6. Estructura de módulos del sistema

La arquitectura modular se organiza de forma que cada módulo de dominio sea dueño de sus propios catálogos específicos. Los servicios transversales como generación de documentos, reportes y notificaciones se ubican dentro del módulo Core como infraestructura compartida, evitando que se conviertan en módulos centralizados que conocen la lógica de todos los demás.

```
Modules/
├── Core/                  → Base, traits, interfaces, helpers
│   ├── Documents/         → Motor de generación (plantillas, lotes, PDF)
│   ├── Reports/           → Motor de reportes (definiciones, ejecución)
│   └── Notifications/     → Canales, despacho, logs
├── Auth/                  → Usuarios, roles, permisos, sesiones
├── Organization/          → Sedes, gerencias, subgerencias, oficinas, áreas, ubicaciones
├── Staff/                 → Empleados, técnicos, proveedores
├── Assets/                → Activos, componentes, licencias, archivos
│   └── Catalogs/          → Categorías, tipos, marcas, modelos, estados, motivos de baja
├── Assignments/           → Asignaciones, movimientos, custodias, cargos de entrega
├── Maintenance/           → Solicitudes, órdenes, registros, costos, evidencias
│   └── Catalogs/          → Tipos de mantenimiento, prioridades
├── Campaigns/             → Campañas, lotes, avance, hitos, técnicos por campaña
├── Agent/                 → Dispositivos, heartbeats, snapshots, alertas, configuración
├── AI/                    → Proveedores, prompts, requests, conversaciones
├── Audit/                 → Activity logs, audit trails, login attempts, eventos del sistema
└── Settings/              → Configuración global, parámetros, umbrales
```

### Justificación de la estructura

* **Core con Documents, Reports y Notifications**: estos tres servicios son transversales. Si fueran módulos independientes, terminarían conociendo la lógica interna de Assets, Maintenance y Campaigns, generando acoplamiento en estrella. Al ubicarlos en Core como infraestructura, cada módulo de dominio define sus propias plantillas, reportes y eventos de notificación usando las interfaces y traits del Core.

* **Staff como módulo separado de Organization**: los empleados y técnicos tienen lógica propia (disponibilidad, especialidad, asignación a campañas, niveles de certificación). Al separarlos de la estructura organizacional, se evita que Organization acumule responsabilidades que no le corresponden.

* **Catálogos distribuidos**: cada módulo de dominio posee sus catálogos específicos. Assets posee tipos, categorías, marcas, modelos y estados. Maintenance posee tipos de mantenimiento y prioridades. Esto reduce el acoplamiento: un cambio en los catálogos de mantenimiento no afecta al módulo de activos.

* **Settings como módulo explícito**: parámetros globales del sistema, umbrales de alertas, frecuencias por defecto, configuración de integración con IA y del agente local necesitan un lugar centralizado. Sin este módulo, la configuración termina dispersa en archivos .env, tablas sueltas y valores hardcoded.

---

## 7. Módulos del sistema: descripción funcional y entidades

---

### 7.1. Módulo Core

Contiene la infraestructura compartida del sistema. No tiene lógica de dominio propia, sino que provee servicios, interfaces, traits y helpers que los demás módulos consumen.

#### 7.1.1. Core / Documents

Motor de generación documental. Provee la capacidad de crear documentos PDF individuales y en lote a partir de plantillas y datos estructurados. Cada módulo de dominio registra sus propias plantillas y tipos de documento.

**Funcionalidades:**

* Definir plantillas de documentos con variables disponibles.
* Generar PDF individuales de forma síncrona.
* Generar lotes de documentos mediante colas para campañas o periodos.
* Generar documentos consolidados (varios registros en un solo PDF).
* Incluir código QR o código de verificación por documento.
* Versionar plantillas.
* Registrar descargas y accesos a documentos.
* Anular documentos con motivo.

**Entidades:**

| Entidad | Descripción |
|---------|-------------|
| `document_types` | Tipos de documento (ficha técnica, acta, orden, constancia, informe). |
| `document_templates` | Plantillas con vista Blade, variables, orientación, tamaño de papel, versionado. |
| `documents` | Documentos generados con UUID, código de verificación, referencia polimórfica al origen, ruta del archivo, QR, estado y metadatos. |
| `document_batches` | Lotes de generación masiva con tipo, filtros, progreso, estado del job y rutas de archivos consolidados o ZIP. |
| `document_batch_items` | Ítems individuales dentro de un lote con estado y referencia al documento generado. |
| `document_downloads` | Registro de cada descarga con usuario, IP, tipo y timestamp. |

#### 7.1.2. Core / Reports

Motor de reportes y dashboards. Provee la capacidad de definir reportes, guardar vistas frecuentes, configurar dashboards y programar reportes automáticos. Cada módulo de dominio registra sus propias definiciones de reportes.

**Funcionalidades:**

* Definir reportes con filtros disponibles, columnas, tipo de gráfico.
* Guardar vistas frecuentes por usuario.
* Configurar dashboards personalizados con widgets.
* Programar reportes automáticos por frecuencia.
* Exportar a Excel, PDF y CSV.
* Registrar ejecuciones de reportes.

**Entidades:**

| Entidad | Descripción |
|---------|-------------|
| `report_definitions` | Definiciones de reportes del sistema con módulo, categoría, filtros, columnas, tipo de gráfico y clase de consulta. |
| `saved_report_views` | Vistas guardadas por usuario con filtros y configuración aplicada. |
| `dashboard_widgets` | Widgets disponibles para dashboards con tipo, fuente de datos y configuración. |
| `user_dashboards` | Dashboards configurados por usuario con tipo y layout. |
| `user_dashboard_widgets` | Instancias de widgets en un dashboard con posición, tamaño y parámetros. |
| `scheduled_reports` | Reportes programados con frecuencia, formato de exportación y destinatarios. |
| `report_executions` | Registro de cada ejecución de reporte con filtros, resultado, duración y archivo generado. |

#### 7.1.3. Core / Notifications

Servicio centralizado de notificaciones. Gestiona el despacho por múltiples canales y mantiene un log unificado.

**Funcionalidades:**

* Despachar notificaciones por email, base de datos y broadcast.
* Registrar cada notificación enviada.
* Rastrear estado de lectura.
* Permitir que cada módulo defina sus propios eventos y plantillas de notificación.

**Entidades:**

| Entidad | Descripción |
|---------|-------------|
| `notifications` | Notificaciones del sistema con canal, tipo, referencia polimórfica al origen, destinatario, contenido, estado de envío y lectura. |
| `notification_templates` | Plantillas de notificación por evento con canal, asunto, cuerpo y variables disponibles. |

---

### 7.2. Módulo Auth

Gestiona la autenticación de usuarios, el control de acceso basado en roles y permisos granulares.

**Funcionalidades:**

* Autenticación con email y contraseña.
* Gestión de sesiones activas.
* Definición de roles con permisos agrupados.
* Asignación de roles a usuarios.
* Asignación de permisos directos a usuarios (allow/deny).
* Recuperación de contraseña.
* Registro del último acceso.

**Entidades:**

| Entidad | Descripción |
|---------|-------------|
| `users` | Usuarios del sistema con email, contraseña, estado activo, último login, IP, vínculo con empleado. |
| `roles` | Roles del sistema (Administrador, Técnico, Supervisor, etc.) con nombre, slug y si es de sistema. |
| `permissions` | Permisos individuales agrupados por módulo (ver activos, crear mantenimiento, gestionar campañas, etc.). |
| `role_user` | Tabla pivot de asignación de roles a usuarios con registro de quién asignó. |
| `permission_role` | Tabla pivot de permisos asignados a roles. |
| `permission_user` | Permisos directos sobre usuario con tipo allow/deny para excepciones puntuales. |
| `sessions` | Sesiones activas con IP, user agent y última actividad. |
| `password_resets` | Tokens de recuperación de contraseña. |

**Roles sugeridos:**

* Administrador del sistema
* Administrador TI
* Técnico de soporte
* Supervisor de mantenimiento
* Responsable de oficina
* Usuario consultor
* Auditor
* Operador documental

**Permisos granulares sugeridos:**

* Ver activos propios / del área / todos
* Crear, editar, dar de baja activos
* Registrar mantenimiento
* Aprobar cierre de mantenimiento
* Gestionar campañas
* Generar documentos
* Exportar reportes
* Consultar módulo IA
* Administrar agente local
* Administrar configuración del sistema

---

### 7.3. Módulo Organization

Administra la estructura jerárquica institucional de la municipalidad.

**Funcionalidades:**

* Registrar y administrar sedes con datos de contacto y ubicación geográfica.
* Registrar gerencias asociadas a sedes.
* Registrar subgerencias dentro de gerencias.
* Registrar oficinas dentro de subgerencias, con sede y piso.
* Registrar áreas dentro de oficinas.
* Registrar ubicaciones físicas con referencia a sede, oficina, piso y edificio.
* Asignar responsables a cada nivel organizacional.

**Entidades:**

| Entidad | Descripción |
|---------|-------------|
| `sedes` | Sedes de la municipalidad con código, nombre, dirección, teléfono, email, coordenadas GPS y estado activo. |
| `gerencias` | Gerencias con código, nombre, abreviatura, sede asociada, responsable y orden de visualización. |
| `subgerencias` | Subgerencias con código, nombre, gerencia asociada y responsable. |
| `oficinas` | Oficinas con código, nombre, subgerencia, sede, responsable, piso y número de ambiente. |
| `areas` | Áreas dentro de oficinas con código, nombre, oficina asociada y responsable. |
| `ubicaciones` | Ubicaciones físicas específicas con código, nombre, referencia, sede, oficina, piso y edificio. |

---

### 7.4. Módulo Staff

Gestiona el personal vinculado al sistema: empleados de la municipalidad, técnicos de soporte y proveedores externos.

**Funcionalidades:**

* Registrar empleados con datos personales, cargo, tipo de vínculo laboral y ubicación organizacional.
* Vincular empleados con usuarios del sistema.
* Registrar técnicos con especialidad, certificación, nivel y disponibilidad.
* Registrar proveedores con datos fiscales, contacto y categoría.
* Consultar disponibilidad de técnicos para asignación.

**Entidades:**

| Entidad | Descripción |
|---------|-------------|
| `employees` | Empleados con código, DNI, nombres, email, teléfono, cargo, tipo de vínculo, oficina, área y usuario vinculado. |
| `tecnicos` | Técnicos de soporte con empleado asociado, especialidad, certificación, nivel (junior/senior/lead) y disponibilidad. |
| `proveedores` | Proveedores externos con RUC, razón social, nombre comercial, contacto, dirección, categoría y notas. |

---

### 7.5. Módulo Assets

Gestiona el inventario completo de activos tecnológicos. Este módulo es dueño de sus catálogos específicos: categorías, tipos de activo, marcas, modelos, estados y motivos de baja.

**Funcionalidades:**

* Registrar activos tecnológicos con datos patrimoniales, técnicos y operativos.
* Gestionar número de serie, código interno y código patrimonial.
* Registrar ubicación, oficina y responsable actual.
* Registrar características técnicas específicas mediante atributos dinámicos según tipo de activo.
* Registrar componentes internos (CPU, RAM, discos, etc.).
* Registrar licencias de software vinculadas al activo.
* Adjuntar imágenes, facturas, garantías y otros archivos.
* Consultar historial completo del activo.
* Marcar estado: operativo, en observación, en mantenimiento, fuera de servicio, de baja.
* Registrar condición, criticidad y datos de depreciación.
* Registrar fecha de compra, garantía, proveedor y valor referencial.
* Importar activos por archivo estructurado.
* Filtrar por cualquier campo relevante.
* Etiquetar activos con tags personalizados.
* Vincular activos con dispositivos detectados por el agente local.
* Gestionar activos compuestos (activo padre con sub-activos).

**Entidades del dominio:**

| Entidad | Descripción |
|---------|-------------|
| `assets` | Activos tecnológicos con UUID, códigos, tipo, marca, modelo, estado, ubicación, responsable, proveedor, valores económicos, criticidad, condición, frecuencia de mantenimiento, vínculo con agente y activo padre. |
| `asset_attributes` | Atributos dinámicos del activo con nombre, valor, tipo de dato y grupo, para características específicas por tipo de activo. |
| `asset_components` | Componentes internos del activo (procesador, RAM, disco, etc.) con marca, modelo, serial, capacidad y estado. |
| `asset_licenses` | Licencias de software vinculadas con nombre, clave, tipo (OEM, retail, volumen, suscripción), versión, fechas, costo y estado. |
| `asset_files` | Archivos adjuntos con tipo (foto, factura, garantía, manual), ruta, tamaño y quién lo subió. |
| `asset_status_histories` | Historial de cambios de estado con estado anterior, nuevo, motivo, notas, motivo de baja si aplica y quién realizó el cambio. |
| `asset_tags` | Etiquetas personalizadas con nombre, slug y color. |
| `asset_tag_pivot` | Tabla pivot de etiquetas asignadas a activos. |

**Catálogos propios del módulo:**

| Entidad | Descripción |
|---------|-------------|
| `asset_categories` | Categorías generales de activos (equipos de cómputo, redes, periféricos, etc.) con icono y orden. |
| `asset_types` | Tipos de activo dentro de categorías (PC escritorio, laptop, impresora, etc.) con atributos por defecto y vida útil. |
| `marcas` | Marcas de equipos (HP, Lenovo, Dell, etc.) con logo. |
| `modelos` | Modelos específicos por marca y tipo de activo con número de parte y especificaciones. |
| `asset_statuses` | Estados posibles del activo (operativo, en observación, en mantenimiento, fuera de servicio, de baja) con reglas de negocio sobre si permite asignación o mantenimiento. |
| `motivos_baja` | Motivos de baja del activo (obsolescencia, daño irreparable, robo, etc.) con indicador de si requiere documento sustentatorio. |

---

### 7.6. Módulo Assignments

Gestiona la asignación de activos a personas, áreas u oficinas, así como los movimientos, traslados y el control de custodia.

**Funcionalidades:**

* Asignar activos a empleados, áreas u oficinas.
* Registrar tipo de asignación (personal, por área, por oficina, temporal).
* Registrar fecha de asignación, fecha esperada de devolución y devolución real.
* Registrar cambios de ubicación y responsable.
* Registrar traslados temporales o permanentes entre sedes, oficinas o áreas.
* Mantener historial de custodia con registro de quién tuvo el activo y en qué periodo.
* Generar constancias de entrega y devolución con detalle de activos y condición.
* Gestionar cargos de entrega con firma del que entrega y del que recibe.

**Entidades:**

| Entidad | Descripción |
|---------|-------------|
| `asset_assignments` | Asignaciones de activos con empleado, oficina, área, ubicación, tipo, fechas, estado, propósito, condiciones y documentos asociados de entrega y devolución. |
| `asset_movements` | Movimientos de activos (traslado, reasignación, préstamo, devolución, retiro, ingreso) con origen y destino completos (sede, oficina, área, ubicación, empleado), motivo, estado, autorización y documento asociado. |
| `asset_custody_records` | Registros de custodia que mantienen la línea de tiempo de quién tuvo el activo, en qué ubicación, desde cuándo y hasta cuándo, si es titular o temporal, y si está vigente. |
| `delivery_receipts` | Cargos de entrega y devolución con código, tipo, referencia a asignación o movimiento, partes involucradas, fecha, firmas y estado. |
| `delivery_receipt_items` | Detalle de activos incluidos en cada cargo con condición al momento de la entrega, observaciones e indicación de accesorios incluidos. |

---

### 7.7. Módulo Maintenance

Gestiona el ciclo completo de mantenimiento individual de activos: desde la solicitud o incidencia hasta el cierre con conformidad. Este módulo es dueño de sus catálogos específicos: tipos de mantenimiento y prioridades.

**Funcionalidades:**

* Registrar solicitudes o incidencias reportadas por usuarios.
* Crear órdenes de trabajo asociadas a solicitudes o directamente sobre activos.
* Registrar tipo de mantenimiento: preventivo, correctivo, diagnóstico o emergencia.
* Asignar técnico responsable y supervisor.
* Registrar diagnóstico técnico, causa raíz y acciones realizadas.
* Registrar tareas individuales dentro de una orden con tipo y estado.
* Registrar repuestos o componentes reemplazados con detalle y costo.
* Registrar costos estimados y reales por categoría (repuesto, mano de obra, traslado, tercero).
* Adjuntar evidencia fotográfica o documental por etapa (antes, durante, después).
* Registrar conformidad del usuario con firma digital.
* Programar próximo mantenimiento sugerido.
* Definir programaciones de mantenimiento preventivo por activo.
* Cambiar estados del proceso de atención.
* Generar acta de mantenimiento y orden de trabajo como documentos.
* Vincular un mantenimiento con una campaña cuando aplique.

**Entidades del dominio:**

| Entidad | Descripción |
|---------|-------------|
| `maintenance_requests` | Solicitudes o incidencias con activo, solicitante, oficina, prioridad, tipo de solicitud, descripción del problema, síntomas, estado del proceso, fechas de asignación, resolución y cierre, técnico asignado, notas de resolución y calificación de satisfacción. |
| `maintenance_orders` | Órdenes de trabajo con solicitud asociada, activo, tipo de mantenimiento, prioridad, vínculo con campaña si aplica, estado, técnico asignado, supervisor, fechas programada/inicio/fin/cierre, duración estimada y real, y notas internas. |
| `maintenance_records` | Registros técnicos del mantenimiento con orden asociada, activo, técnico, fecha, problema reportado, diagnóstico, causa raíz, acciones realizadas, recomendaciones, condición del activo antes y después, nuevo estado, fecha sugerida de próximo mantenimiento e indicador de seguimiento. |
| `maintenance_tasks` | Tareas individuales dentro de una orden o registro con tipo (diagnóstico, limpieza, reparación, reemplazo, actualización, configuración), estado, tiempo estimado y real, y observaciones. |
| `maintenance_parts` | Repuestos y componentes utilizados con tipo, nombre, marca, modelo, serial nuevo y anterior, cantidad, costo unitario y total, proveedor y estado de instalación. |
| `maintenance_evidences` | Evidencias adjuntas con tipo (foto antes/después/proceso, captura, documento, video), etapa del mantenimiento, archivo y quién lo subió. |
| `maintenance_costs` | Costos del mantenimiento por categoría con monto estimado y real, moneda, proveedor, factura, estado de aprobación y quién aprobó. |
| `maintenance_signatures` | Firmas y conformidades con tipo de firmante (técnico, responsable, supervisor, usuario), datos del firmante, firma digital, indicador de conformidad, observaciones, IP y timestamp. |
| `maintenance_schedule` | Programación de mantenimiento preventivo por activo con tipo, frecuencia, última ejecución, próxima fecha programada, técnico asignado y estado activo. |

**Catálogos propios del módulo:**

| Entidad | Descripción |
|---------|-------------|
| `maintenance_types` | Tipos de mantenimiento (preventivo, correctivo, diagnóstico, emergencia) con color, indicador de si requiere aprobación y estado activo. |
| `maintenance_priorities` | Prioridades de atención (crítica, alta, media, baja) con nivel numérico, color, tiempo máximo de respuesta y tiempo máximo de resolución. |

---

### 7.8. Módulo Campaigns

Gestiona las campañas de mantenimiento masivo. Una campaña es una entidad de negocio de primera clase con su propio ciclo de vida, no un simple filtro sobre mantenimientos individuales.

### Concepto

Una campaña de mantenimiento es una operación planificada que permite intervenir en un conjunto de activos, ya sea de una oficina, una sede, una gerencia o toda la municipalidad, dentro de un periodo definido. Tiene coordinadores, técnicos asignados, lotes de activos, hitos, indicadores de avance y documentación propia.

**Funcionalidades:**

* Crear campañas con nombre, objetivo, periodo, alcance y responsables.
* Definir filtros de alcance para selección de activos:
  * Toda la municipalidad
  * Por sede
  * Por gerencia
  * Por subgerencia
  * Por oficina
  * Por tipo de activo
  * Por estado del activo
  * Por fecha de último mantenimiento
  * Por criticidad
* Generar lotes de activos objetivo por campaña.
* Asignar técnicos por lote, zona o sede.
* Registrar avance diario de la campaña.
* Registrar mantenimiento individual dentro del contexto de una campaña (la orden de mantenimiento se vincula con el activo de campaña).
* Definir hitos de la campaña con fechas objetivo y estado.
* Medir indicadores de campaña: cobertura, pendientes, completados, observados, fuera de servicio, costos estimados y ejecutados, tiempo promedio de atención.
* Reprogramar activos no atendidos a otra fecha o a otra campaña.
* Generar informes consolidados por campaña.
* Generar actas individuales y documentos masivos.
* Enviar notificaciones de inicio, avance, recordatorio, cierre y reprogramación.
* Aprobar y cerrar campañas con resumen ejecutivo y recomendaciones.

**Indicadores de campaña:**

* Total de activos programados
* Total atendidos
* Total pendientes
* Total observados
* Total fuera de servicio
* Costo estimado
* Costo ejecutado
* Cobertura porcentual
* Tiempo promedio de atención

**Entidades:**

| Entidad | Descripción |
|---------|-------------|
| `maintenance_campaigns` | Campañas con código, nombre, objetivo, descripción, estado, tipo de mantenimiento, alcance, fechas planificadas y reales, totales de activos (programados, atendidos, pendientes, observados, fuera de servicio), costos estimados y ejecutados, cobertura, tiempo promedio, resumen de cierre, coordinador, aprobador, y quién cerró. |
| `campaign_scope_filters` | Filtros de alcance de la campaña con tipo (sede, gerencia, oficina, tipo de activo, estado, criticidad, último mantenimiento), operador y valor. |
| `campaign_assets` | Activos incluidos en la campaña con técnico asignado, estado individual (programado, en proceso, completado, observado, reprogramado, no atendido, fuera de servicio), número de lote, zona, fecha programada, fecha atendida, vínculo con orden de mantenimiento, prioridad y datos de reprogramación. |
| `campaign_technicians` | Técnicos asignados a la campaña con rol (líder, técnico, apoyo), zona asignada, sede, lote, periodo, totales asignados y completados. |
| `campaign_progress` | Registro diario de avance con acumulados de atendidos, pendientes, observados, fuera de servicio, costo y cobertura. |
| `campaign_milestones` | Hitos de la campaña con nombre, descripción, fecha objetivo, fecha real, estado y responsable. |
| `campaign_documents` | Documentos asociados a la campaña con rol del documento (plan, informe de avance, informe final, acta individual, resumen de lote, aprobación, cierre). |
| `campaign_notifications` | Notificaciones de campaña con destinatario, tipo (inicio, recordatorio, avance, cierre, reprogramación), canal, mensaje y estado de lectura. |

**Catálogos propios del módulo:**

| Entidad | Descripción |
|---------|-------------|
| `campaign_statuses` | Estados de la campaña (planificada, aprobada, en ejecución, pausada, cerrada, cancelada) con color y orden. |

---

### 7.9. Módulo Agent

Gestiona el agente local instalado en PCs institucionales que recolecta información técnica real y la sincroniza con el sistema central.

### Objetivo del agente

Obtener información técnica real de cada equipo institucional y sincronizarla con el sistema central para mejorar el inventario, detectar cambios y apoyar la gestión de mantenimiento.

**Funcionalidades:**

* Registrar dispositivos automáticamente con identificador único y token de autenticación.
* Detectar hostname, fabricante, modelo, serial, usuario actual y dominio.
* Detectar hardware: CPU, RAM (módulos, total, disponible), discos, GPU, monitores, periféricos USB.
* Detectar software: sistema operativo, versión, build, software instalado, antivirus, actualizaciones pendientes.
* Detectar red: IP, MAC, adaptadores, gateway, DNS, dominio, WiFi, VPN.
* Enviar heartbeat periódico con métricas de CPU, RAM, disco y conectividad.
* Enviar snapshots cuando detecte cambios importantes en hardware, software o red.
* Comparar snapshots para identificar cambios con resumen de diferencias.
* Generar alertas automáticas por cambios de hardware, disco crítico, RAM crítica, equipo offline, problemas de antivirus, software no autorizado o cambios de red.
* Vincular dispositivos detectados con activos del inventario de forma manual o semi-automática.
* Registrar log de cada sincronización con resultado, tiempo de respuesta y errores.
* Mantener configuración del agente desde el sistema central.

### Información que recolecta el agente

**Hardware:** hostname, fabricante, modelo, serial del equipo, placa base, procesador (nombre, cores, threads, velocidad), RAM (total, disponible, slots, módulos), discos (capacidad, espacio libre), GPU, monitores, periféricos USB.

**Software:** sistema operativo (nombre, versión, build, arquitectura, estado de licencia), nombre del equipo en red, software instalado con conteo, antivirus (nombre, estado, versión, última actualización), programas de inicio, actualizaciones pendientes.

**Red:** IP local, MAC, adaptadores de red, gateway, DNS, dominio o grupo de trabajo, estado WiFi (SSID, señal), estado VPN, puertos abiertos.

**Estado:** uptime, última sincronización, estado del agente.

### Seguridad del agente

* Autenticación con token por dispositivo.
* Rotación de credenciales.
* Uso de HTTPS.
* Validación de integridad del payload.
* Trazabilidad de envíos.
* Control de frecuencia de sincronización.

### API para el agente

Endpoints sugeridos: registro inicial del dispositivo, heartbeat, envío de snapshot de hardware, envío de snapshot de software, envío de snapshot de red, reporte de alertas técnicas.

**Entidades:**

| Entidad | Descripción |
|---------|-------------|
| `agent_devices` | Dispositivos registrados con UUID, token, hostname, identificador, fabricante, modelo, serial, sistema operativo, versión del agente, activo vinculado, estado de vinculación, estado online, última IP, último heartbeat, primera y última sincronización. |
| `agent_heartbeats` | Heartbeats periódicos con IP, versión del agente, uptime, uso de CPU/RAM/disco, conectividad a internet, estado general y métricas extra. |
| `agent_hardware_snapshots` | Snapshots de hardware con hash para detectar cambios, datos completos de hostname, fabricante, modelo, serial, BIOS, placa base, procesador, RAM (total, disponible, slots, módulos), discos, monitores, GPU, USB, periféricos, indicador de cambios y resumen de diferencias respecto al snapshot previo. |
| `agent_software_snapshots` | Snapshots de software con hash, sistema operativo completo, software instalado con conteo, antivirus (nombre, estado, versión, última actualización), programas de inicio, actualizaciones pendientes, indicador de cambios y resumen de diferencias. |
| `agent_network_snapshots` | Snapshots de red con hash, adaptadores, IP/MAC primarios, gateway, DNS, dominio, WiFi (SSID, señal), VPN, puertos abiertos, indicador de cambios y resumen de diferencias. |
| `agent_alerts` | Alertas generadas con tipo (cambio de hardware, disco crítico, equipo offline, antivirus, software no autorizado, cambio de red), severidad, título, descripción, datos de la alerta, estado (nueva, vista, atendida, descartada), quién atendió y notas de resolución. |
| `agent_config` | Configuración del agente gestionada desde el sistema central con clave, valor, tipo de dato y descripción. |
| `agent_sync_logs` | Log de cada sincronización con tipo (heartbeat, hardware, software, red, alerta, registro), estado, tamaño del payload, tiempo de respuesta, IP y errores. |

### Consideraciones técnicas del agente

Se recomienda desarrollarlo como componente separado del sistema principal, con arquitectura simple y segura.

Posibles tecnologías: Go, C# o Python.

Criterios de elección: facilidad de despliegue en Windows, estabilidad del servicio, tamaño del ejecutable y facilidad de actualización.

---

### 7.10. Módulo AI

Gestiona la integración opcional con servicios externos de LLM. Debe funcionar como complemento, nunca como dependencia obligatoria. Si el servicio LLM no está disponible, el sistema sigue operando completamente.

### Principio de diseño

El sistema debe seguir funcionando completamente si el servicio LLM no está disponible. El LLM será un apoyo opcional y desacoplado. Cada funcionalidad asistida por IA debe tener su equivalente manual.

**Usos recomendados del LLM:**

* Redactar observaciones técnicas más formales.
* Resumir historial de mantenimientos de un activo, área o campaña.
* Sugerir posibles causas según síntomas reportados.
* Proponer texto preliminar para informes técnicos.
* Clasificar incidencias por prioridad o categoría.
* Responder consultas en lenguaje natural (qué activos presentan más incidencias, resume la campaña del mes, redacta un informe del área X).

**Qué no debe hacer el LLM:**

* No debe modificar datos directamente por sí solo.
* No debe ser fuente de verdad.
* No debe reemplazar validaciones del negocio.
* No debe bloquear flujos operativos.

**Modo manual alternativo:**

* Redacción manual de observaciones.
* Generación manual de informes desde plantillas.
* Búsqueda tradicional por filtros.
* Reportes tradicionales sin interpretación automática.

**Funcionalidades:**

* Configurar proveedores de IA con modelo, tokens, temperatura, límites de uso y costos.
* Definir plantillas de prompts por categoría y módulo con variables requeridas y formato de salida esperado.
* Registrar cada solicitud enviada al LLM con contexto, tokens consumidos, costo estimado, tiempo de respuesta y estado.
* Registrar cada respuesta recibida con contenido original, contenido editado si se modificó, acción tomada (aceptada, editada, rechazada, ignorada), calificación de calidad y si fue aplicada a algún registro.
* Gestionar conversaciones multi-turno con historial de mensajes.
* Registrar estadísticas de uso por proveedor, módulo y categoría.
* Activar o desactivar la integración sin afectar el sistema.
* No bloquear el flujo manual si el servicio no está disponible.

**Arquitectura de integración:**

Laravel se conectará a un servicio externo de IA mediante una capa de abstracción propia:

* AIProviderInterface — contrato para cambiar de proveedor.
* ExternalLLMService — implementación concreta.
* PromptBuilder — constructor de prompts con variables.
* AIContextAssembler — ensamblador de contexto con datos de la base.
* AIResponseSanitizer — limpieza y validación de respuestas.

**Flujo de integración:**

1. Usuario solicita ayuda asistida.
2. Sistema construye contexto con datos de la base.
3. Se envía solicitud al servicio LLM.
4. Se recibe respuesta.
5. Se muestra como sugerencia o borrador editable.
6. Se registra auditoría del intercambio.

**Entidades:**

| Entidad | Descripción |
|---------|-------------|
| `ai_providers` | Proveedores de IA con tipo (OpenAI, Anthropic, Google, Azure, Ollama, custom), URL, API key cifrada, modelo por defecto, modelos disponibles, configuración de tokens/temperatura, límites de uso diario y mensual, costos por token, estado activo, último health check. |
| `ai_prompt_templates` | Plantillas de prompts con código, categoría (redacción, resumen, diagnóstico, clasificación, consulta, informe, análisis), módulo, prompt de sistema, prompt de usuario con variables, formato de salida, versión y ejemplo de resultado esperado. |
| `ai_requests` | Solicitudes enviadas al LLM con UUID, proveedor, plantilla, usuario, modelo usado, categoría, módulo, referencia polimórfica al contexto, prompts enviados, datos de contexto, tokens de entrada/salida, costo estimado, tiempo de respuesta, estado y errores. |
| `ai_responses` | Respuestas del LLM con respuesta original y parseada, formato de salida, acción del usuario (aceptada, editada, rechazada, ignorada), contenido editado, motivo de rechazo, calificación de calidad, indicador de utilidad, y referencia a dónde se aplicó si fue aceptada. |
| `ai_conversations` | Conversaciones multi-turno con UUID, usuario, proveedor, título, módulo, referencia polimórfica al contexto, estado (activa, cerrada, archivada), totales de mensajes, tokens y costo. |
| `ai_conversation_messages` | Mensajes individuales de conversación con rol (user, assistant, system), contenido, tokens y secuencia. |
| `ai_usage_stats` | Estadísticas agregadas de uso por proveedor, fecha, módulo y categoría con totales de solicitudes, tokens, costos, tiempos promedio, calificación promedio y conteos de aceptación/rechazo. |

---

### 7.11. Módulo Audit

Registra todas las acciones, cambios, accesos y eventos del sistema para garantizar trazabilidad completa. Se implementa desde el inicio del proyecto.

**Funcionalidades:**

* Registrar quién creó, modificó, eliminó o restauró cualquier registro.
* Registrar valores anteriores y nuevos en cada cambio con lista de campos modificados.
* Registrar quién generó, descargó o anuló documentos.
* Registrar datos enviados por el agente local.
* Registrar solicitudes y respuestas del módulo LLM.
* Registrar accesos al sistema con IP, user agent y resultado.
* Registrar intentos de login fallidos con motivo.
* Registrar exportaciones de datos con filtros, cantidad de registros y archivo generado.
* Registrar eventos del sistema (job fallido, cola atascada, agente offline, proveedor de IA caído, disco lleno, error en lote).
* Clasificar eventos por severidad.
* Permitir revisión de eventos críticos con notas de resolución.

**Entidades:**

| Entidad | Descripción |
|---------|-------------|
| `activity_logs` | Log de actividades con UUID, usuario, acción (create, update, delete, view, download, export, login, assign, approve, generate, import), módulo, referencia polimórfica al registro afectado, descripción, valores anteriores y nuevos, campos modificados, IP, user agent, sesión, ruta, URL, método HTTP, código de respuesta y duración. |
| `audit_trails` | Trails de auditoría con UUID, usuario, tipo de evento (cambio de datos, acceso, seguridad, sistema, documento, sync del agente, interacción IA, acción de campaña, operación masiva), severidad, módulo, referencia a la entidad, acción, resumen, estados antes/después, contexto, indicador de si es evento de sistema, indicador de si requiere revisión, quién revisó y notas de revisión. |
| `login_attempts` | Intentos de acceso con usuario, email, IP, user agent, resultado (exitoso/fallido), motivo de fallo, país y ciudad. |
| `data_exports` | Exportaciones de datos con usuario, formato (Excel, PDF, CSV, JSON), módulo, tipo de entidad, filtros aplicados, cantidad de registros, archivo, estado, fecha de solicitud, completado y expiración. |
| `system_events` | Eventos del sistema con tipo, severidad, fuente (sistema, cola, agente, IA, scheduler, storage), título, descripción, datos del evento, estado (nuevo, reconocido, resuelto, ignorado), quién reconoció, quién resolvió y notas de resolución. |

---

### 7.12. Módulo Settings

Gestiona la configuración global del sistema, parámetros operativos, umbrales de alertas y valores por defecto.

**Funcionalidades:**

* Definir parámetros globales del sistema (nombre de la institución, logo, datos de contacto para documentos).
* Configurar umbrales de alertas del agente (porcentaje crítico de disco, RAM, CPU, días sin heartbeat).
* Configurar frecuencias por defecto de mantenimiento preventivo.
* Configurar parámetros de generación documental (orientación, tamaño, si incluye QR).
* Configurar parámetros de integración con IA (activada/desactivada, proveedor por defecto, límites).
* Configurar parámetros de notificaciones (canales habilitados, horarios).
* Agrupar configuraciones por módulo o categoría.
* Cachear configuración frecuente.
* Registrar cambios de configuración en auditoría.

**Entidades:**

| Entidad | Descripción |
|---------|-------------|
| `settings` | Configuración global con clave única, valor, tipo de dato (string, integer, boolean, json, text), módulo al que pertenece, grupo, descripción, valor por defecto, indicador de si es editable por usuario, indicador de si es sensible (se oculta en UI), orden de visualización. |
| `setting_histories` | Historial de cambios de configuración con setting asociado, valor anterior, valor nuevo, quién cambió y timestamp. |

---

## 8. Requerimientos funcionales detallados

### 8.1. Inventario

* Registrar activos manualmente.
* Importar activos por archivo estructurado.
* Editar datos del activo.
* Adjuntar documentos y fotos.
* Consultar historial técnico y administrativo.
* Filtrar por cualquier campo relevante.

### 8.2. Mantenimiento individual

* Crear mantenimiento desde una incidencia.
* Crear mantenimiento directamente sobre un activo.
* Cambiar estados del proceso de atención.
* Guardar evidencias y observaciones.
* Generar documento asociado.

### 8.3. Campañas

* Crear campaña con filtros de selección.
* Generar lote de activos objetivo.
* Asignar responsables y técnicos.
* Registrar avance por activo.
* Cerrar campaña con resumen ejecutivo.

### 8.4. Documentos

* Generar PDF individual.
* Generar PDF consolidado.
* Generar múltiples documentos en lote.
* Exportar resultados por campaña o por área.

### 8.5. Reportes

* Visualizar gráficos.
* Exportar a Excel o PDF.
* Aplicar filtros avanzados.
* Guardar vistas frecuentes.

### 8.6. Agente local

* Registrar el equipo automáticamente.
* Enviar hardware y software detectado.
* Enviar heartbeat periódico.
* Registrar cambios de configuración relevantes.
* Vincular el equipo detectado con un activo del inventario.

### 8.7. IA opcional

* Activar o desactivar integración.
* Registrar prompts y respuestas.
* No bloquear el flujo manual si el servicio no está disponible.

---

## 9. Requerimientos no funcionales

* Seguridad de acceso por roles y permisos.
* Trazabilidad completa desde el inicio.
* Escalabilidad modular.
* Disponibilidad para múltiples áreas simultáneamente.
* Soporte para generación masiva de documentos mediante colas.
* Interfaz clara para uso administrativo y técnico.
* Diseño orientado a mantenimiento y crecimiento futuro.
* Integración desacoplada con servicios externos.
* Capacidad de operación aun cuando falle el servicio LLM.

---

## 10. Arquitectura propuesta

### 10.1. Arquitectura general

Se propone una arquitectura modular compuesta por:

* Aplicación web principal en Laravel
* Base de datos relacional
* Motor de colas para tareas pesadas
* Almacenamiento de archivos
* Servicio externo de LLM
* Agente local instalado en equipos institucionales

### 10.2. Componentes principales

**A. Sistema principal**

Responsable de gestionar activos, mantenimientos, campañas, generar documentos, mostrar reportes, administrar usuarios y permisos, exponer API para el agente y exponer API interna para integración con LLM.

**B. Agente local**

Responsable de recolectar información de la PC, enviar datos al sistema, reportar cambios relevantes y mantener heartbeat.

**C. Servicio LLM externo**

Responsable de análisis textual, redacción técnica asistida, clasificación o resumen, y consultas en lenguaje natural.

**D. Motor de colas**

Responsable de generar PDFs masivos, exportar reportes grandes, procesar campañas extensas y ejecutar sincronizaciones pesadas.

---

## 11. Diseño técnico en Laravel

### 11.1. Estructura de módulos

```
Modules/
├── Core/
│   ├── Documents/
│   ├── Reports/
│   └── Notifications/
├── Auth/
├── Organization/
├── Staff/
├── Assets/
│   └── Catalogs/
├── Assignments/
├── Maintenance/
│   └── Catalogs/
├── Campaigns/
├── Agent/
├── AI/
├── Audit/
└── Settings/
```

### 11.2. Capas sugeridas por módulo

Cada módulo debería tener:

* Controllers
* Requests
* Actions
* Services
* Repositories
* DTOs
* Models
* Policies
* Jobs
* Events
* Listeners

Esto permitirá mantener la lógica desacoplada y escalable.

---

## 12. Modelo de datos consolidado

### Auth

* `users`
* `roles`
* `permissions`
* `role_user`
* `permission_role`
* `permission_user`
* `sessions`
* `password_resets`

### Organization

* `sedes`
* `gerencias`
* `subgerencias`
* `oficinas`
* `areas`
* `ubicaciones`

### Staff

* `employees`
* `tecnicos`
* `proveedores`

### Assets (dominio + catálogos)

* `assets`
* `asset_attributes`
* `asset_components`
* `asset_licenses`
* `asset_files`
* `asset_status_histories`
* `asset_tags`
* `asset_tag_pivot`
* `asset_categories`
* `asset_types`
* `marcas`
* `modelos`
* `asset_statuses`
* `motivos_baja`

### Assignments

* `asset_assignments`
* `asset_movements`
* `asset_custody_records`
* `delivery_receipts`
* `delivery_receipt_items`

### Maintenance (dominio + catálogos)

* `maintenance_requests`
* `maintenance_orders`
* `maintenance_records`
* `maintenance_tasks`
* `maintenance_parts`
* `maintenance_evidences`
* `maintenance_costs`
* `maintenance_signatures`
* `maintenance_schedule`
* `maintenance_types`
* `maintenance_priorities`

### Campaigns (dominio + catálogo)

* `maintenance_campaigns`
* `campaign_scope_filters`
* `campaign_assets`
* `campaign_technicians`
* `campaign_progress`
* `campaign_milestones`
* `campaign_documents`
* `campaign_notifications`
* `campaign_statuses`

### Core / Documents

* `document_types`
* `document_templates`
* `documents`
* `document_batches`
* `document_batch_items`
* `document_downloads`

### Core / Reports

* `report_definitions`
* `saved_report_views`
* `dashboard_widgets`
* `user_dashboards`
* `user_dashboard_widgets`
* `scheduled_reports`
* `report_executions`

### Core / Notifications

* `notifications`
* `notification_templates`

### Agent

* `agent_devices`
* `agent_heartbeats`
* `agent_hardware_snapshots`
* `agent_software_snapshots`
* `agent_network_snapshots`
* `agent_alerts`
* `agent_config`
* `agent_sync_logs`

### AI

* `ai_providers`
* `ai_prompt_templates`
* `ai_requests`
* `ai_responses`
* `ai_conversations`
* `ai_conversation_messages`
* `ai_usage_stats`

### Audit

* `activity_logs`
* `audit_trails`
* `login_attempts`
* `data_exports`
* `system_events`

### Settings

* `settings`
* `setting_histories`

### Relaciones clave

* Un departamento (gerencia) tiene muchas subgerencias, y estas muchas oficinas.
* Una oficina tiene muchas áreas y muchos activos.
* Un empleado puede ser técnico (relación uno a uno opcional).
* Un activo puede tener muchas asignaciones, movimientos, mantenimientos y participar en muchas campañas.
* Una campaña tiene muchos activos, técnicos, hitos y registros de avance.
* Un mantenimiento puede estar asociado o no a una campaña.
* Un activo puede vincularse con un dispositivo detectado por el agente.
* Un documento puede referenciar un activo, mantenimiento, campaña o asignación mediante relación polimórfica.
* Cada módulo de dominio registra sus propios tipos de documento y definiciones de reporte en las tablas del Core.

---

## 13. Flujo operativo del sistema

### 13.1. Flujo de alta de activo

1. Registro del activo con datos patrimoniales y técnicos.
2. Asignación de ubicación y responsable.
3. Carga de evidencia documental.
4. Generación de ficha técnica.
5. Vinculación con agente local si aplica.

### 13.2. Flujo de mantenimiento individual

1. Se reporta la incidencia o necesidad.
2. Se crea orden de mantenimiento.
3. Se asigna técnico.
4. Se realiza diagnóstico.
5. Se registran acciones y repuestos.
6. Se actualiza estado del activo.
7. Se adjuntan evidencias.
8. Se genera acta.
9. Se cierra con conformidad si aplica.

### 13.3. Flujo de campaña de mantenimiento

1. Se crea la campaña con nombre, objetivo y periodo.
2. Se define alcance mediante filtros.
3. Se genera lote de activos objetivo.
4. Se asignan técnicos o brigadas por zona o lote.
5. Se atienden activos durante la campaña.
6. Se registran mantenimientos vinculados a la campaña.
7. Se monitorea el avance diario.
8. Se cierran pendientes o se reprograman.
9. Se genera informe final consolidado con resumen ejecutivo.

### 13.4. Flujo de generación documental masiva

1. Usuario selecciona campaña, área o periodo.
2. Sistema identifica activos o mantenimientos relacionados.
3. Se encola proceso de generación.
4. Se construyen documentos PDF individuales o consolidados.
5. Se publica resultado para descarga o archivo institucional.

---

## 14. Documentos que debe generar el sistema

### 14.1. Individuales

* Ficha técnica del activo
* Acta de mantenimiento
* Orden de trabajo
* Constancia de entrega o devolución
* Historial técnico del activo

### 14.2. Masivos o consolidados

* Resumen de mantenimientos por oficina
* Resumen por campaña
* Informe por gerencia
* Relación de activos observados
* Relación de activos atendidos por técnico
* Resumen de costos por área
* Paquete documental por campaña

### 14.3. Contenido de un acta de mantenimiento

Debe incluir como mínimo: datos institucionales, datos del activo, oficina y responsable, fecha y hora de atención, problema reportado, diagnóstico técnico, acciones realizadas, repuestos utilizados, estado final, observaciones, firmas o conformidades, código de verificación o QR.

---

## 15. Reportes clave

* Inventario total por sede, gerencia y oficina
* Activos por estado
* Activos por tipo
* Activos sin responsable
* Activos sin mantenimiento reciente
* Mantenimientos por técnico
* Mantenimientos por campaña
* Costos por periodo
* Costos por área
* Activos reincidentes
* Activos críticos
* Equipos detectados por agente sin vinculación formal
* Equipos con características por debajo del estándar

---

## 16. Estrategia de generación documental

Los documentos deben construirse a partir de plantillas y datos estructurados del sistema.

### Recomendaciones

* Plantillas HTML o Blade para PDF.
* Versionado de plantillas.
* Generación síncrona para documentos pequeños.
* Generación por colas para lotes o campañas grandes.
* Código QR o código de validación por documento.

---

## 17. Estrategia de reportes

### 17.1. Reportes operativos

Para técnicos y supervisores: pendientes de atención, avance de campañas, activos por revisar, activos fuera de servicio.

### 17.2. Reportes administrativos

Para jefaturas o gerencias: resumen por área, costos de mantenimiento, cobertura por campaña, obsolescencia del parque tecnológico.

### 17.3. Reportes estratégicos

Para toma de decisiones: activos con alta reincidencia, renovación priorizada, distribución tecnológica institucional, proyección presupuestal aproximada.

---

## 18. Fases del proyecto

### Fase 1: Análisis y diseño

* Levantamiento funcional.
* Definición de catálogos por módulo.
* Definición de roles y permisos.
* Definición de flujos.
* Diseño de modelo de datos.
* Prototipo UI inicial.

### Fase 2: Núcleo del sistema

* Módulo Auth: autenticación y permisos.
* Módulo Organization: estructura institucional.
* Módulo Staff: empleados, técnicos, proveedores.
* Módulo Assets: inventario con catálogos propios.
* Módulo Assignments: asignaciones y movimientos.
* Módulo Maintenance: mantenimientos individuales con catálogos propios.
* Módulo Audit: trazabilidad desde el inicio.
* Módulo Settings: configuración base.
* Core / Notifications: servicio base de notificaciones.

### Fase 3: Documentos y reportes

* Core / Documents: motor de generación documental.
* Fichas técnicas, actas de mantenimiento, órdenes de trabajo.
* Core / Reports: motor de reportes.
* Reportes básicos y dashboards iniciales.

### Fase 4: Campañas de mantenimiento

* Módulo Campaigns: creación, lotes, técnicos, avance, hitos.
* Informes consolidados por campaña.
* Documentos masivos.

### Fase 5: Agente local

* Módulo Agent: desarrollo del agente, API de sincronización.
* Vinculación con activos del inventario.
* Visualización de snapshots, heartbeats y alertas.

### Fase 6: Integración con LLM externo

* Módulo AI: capa de integración con proveedores.
* Plantillas de prompts base.
* Resúmenes asistidos, consultas naturales.
* Auditoría de interacciones con IA.

### Fase 7: Optimización y escalado

* Optimización de colas.
* Exportaciones grandes.
* Métricas avanzadas.
* Alertas preventivas.
* Mejoras UX.

---

## 19. Roadmap sugerido de implementación

### Etapa 1 — MVP operativo

Usuarios y permisos, estructura organizacional, personal, inventario de activos, mantenimiento individual, documentos básicos, auditoría base, configuración inicial.

### Etapa 2 — Operación institucional

Reportes, dashboards, campañas de mantenimiento, documentos consolidados, notificaciones.

### Etapa 3 — Automatización técnica

Agente local, vinculación automática o semi-automática, alertas técnicas, snapshots y heartbeats.

### Etapa 4 — Asistencia inteligente

Integración LLM, consultas naturales, redacción asistida, resúmenes ejecutivos.

---

## 20. Riesgos y mitigaciones

### Riesgos funcionales

* Datos incompletos del inventario inicial.
* Resistencia al cambio en las áreas.
* Mala estandarización de activos.

**Mitigación:** plantillas de carga inicial, catálogos cerrados por módulo, capacitación y validación progresiva.

### Riesgos técnicos

* Crecimiento desordenado del código.
* Lentitud en reportes grandes.
* Fallos del servicio LLM externo.
* Inconsistencia entre inventario real y reportado por agente.

**Mitigación:** arquitectura modular con catálogos distribuidos, uso de colas, LLM desacoplado y opcional, conciliación manual asistida entre agente y activo.

### Riesgos de seguridad

* Exposición de datos de equipos.
* Abuso de endpoints del agente.
* Acceso indebido a reportes sensibles.

**Mitigación:** autenticación robusta, permisos granulares, cifrado en tránsito, auditoría completa desde el inicio.

---

## 21. Decisiones de diseño recomendadas

* El sistema debe ser útil desde su primera fase, sin depender de IA.
* La campaña de mantenimiento debe ser entidad de negocio principal, no solo un filtro sobre mantenimientos.
* El agente debe ser un componente independiente y seguro.
* El LLM debe estar abstraído detrás de una interfaz para cambiar de proveedor fácilmente.
* Los documentos deben salir del sistema como consecuencia natural de los datos registrados.
* La auditoría debe implementarse desde el inicio.
* Cada módulo de dominio debe ser dueño de sus catálogos específicos para reducir acoplamiento.
* Los servicios transversales (documentos, reportes, notificaciones) deben vivir como infraestructura compartida en Core, no como módulos centralizados que conocen la lógica de todos.
* Empleados y técnicos deben tener su propio módulo (Staff) por la lógica específica que manejan.
* La configuración global debe tener un módulo explícito (Settings) para evitar dispersión.

---

## 22. Resultado esperado

Al finalizar el proyecto, la municipalidad debe contar con un sistema capaz de:

* Conocer con precisión qué activos tecnológicos posee.
* Saber dónde están y quién los usa.
* Controlar mantenimientos individuales y masivos.
* Ejecutar campañas institucionales de mantenimiento.
* Generar documentación formal automáticamente.
* Obtener reportes útiles para gestión técnica y administrativa.
* Recibir información real desde PCs institucionales.
* Aprovechar IA como apoyo, sin depender de ella para operar.

---

## 23. Conclusión

El sistema no debe verse solo como un registro de reparaciones. Debe concebirse como una plataforma integral de gestión de activos tecnológicos, mantenimiento, campañas institucionales, documentación, monitoreo técnico y apoyo inteligente.

La clave del éxito estará en construir primero un núcleo sólido: inventario, trazabilidad, mantenimiento, campañas y documentos. Sobre esa base se incorpora el agente local y, finalmente, la capa de IA como complemento estratégico.

La arquitectura modular con catálogos distribuidos, servicios transversales en Core y módulos de dominio independientes garantiza que el sistema pueda crecer y mantenerse sin que los cambios en un módulo afecten a los demás.