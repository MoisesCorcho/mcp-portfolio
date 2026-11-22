# V2 Extruded Boxes Design Primitive
Cross-cutting 2.5D axonometric extruded box primitive for Portfolio V2 components.
Branch: feat/v2-extruded-boxes

## Specs
S1: "quier que analices detalladamente el diseño y estilo de esa pagina, me gustó mucho espcialmente el efecto como de caja 3d que tienen los botones o ciertos div"
S2: "mi idea es poder añadir el nuevo diseño de caja a lo que querramos, es decir, poderlo añadir a los botones, poderlo añadir a las tarjetas de Mis proyectos recientes a las de Experiencia, educación y certificados, etc"
S3: "dejar las caras frontales de ese tono y que cuando se tenga el cursor por encima en lugar de cambiar a un tono mas claro para dar la retroalimentacion como actualmente sucede, que tal pasar unas lineas por encima del boton dando este efecto como de brillo o baso de vidrio limpio"
S4: "lo que si me parece adecuado es una pequeña separacion perceptible entre las opciones de proyecto y la opcion que se usa para expandir las cards"
S5: "teniendo en cuenta lo que descubriste en el primer punto, necesito que por cada seccion por cada parte de esta v2, reviuses que todo esté modularizado, necesitamos DRY correctamente"

## Tasks
- [x] T1 (S1, S2) [inline]: Build `<x-v2.extruded-box>` polymorphic Blade component with Cyber-Industrial dark facets, variable depth, and dynamic SVG/CSS projection. Commit: d785a0c.
- [x] T2 (S2) [inline]: Implement interactive button variant with mechanical press-down physics and integrate into Hero & Contact CTAs. Commit: d785a0c.
- [x] T3 (S2) [inline]: Integrate extruded box primitive into Portfolio V2 Projects 3x3 showroom cards. Commit: d785a0c.
- [x] T4 (S2) [inline]: Integrate extruded box primitive into Experience timeline nodes, Education, and Certification cards. Commit: d785a0c.
- [x] T5 (S2) [inline]: Wrap experience cards with unclipped depth=md extruded boxes and terminate spine rail precisely at final node. Commit: c42d119.
- [x] T6 (S3, S4, S5) [inline]: Elevate resting chiaroscuro, implement glass sheen glint, separate project filter controls, and perform complete DRY modularization audit. Commit: 89bcc5d.

## Log
L1: "https://stupydoo.com.mx/  quier que analices detalladamente el diseño y estilo de esa pagina, me gustó mucho espcialmente el efecto como de caja 3d que tienen los botones o ciertos div"
L2: "mi idea es poder añadir el nuevo diseño de caja a lo que querramos, es decir, poderlo añadir a los botones, poderlo añadir a las tarjetas de Mis proyectos recientes a las de Experiencia, educación y certificados, etc"
L3: "procede en una nueva rama no sin antes haber hecho el push de la rama actual"
L4: "1. envuelve los div de experiencia laboral\n2. la linea izquierda que va uniendo cada experiencia laboral debe terminar en la ultima experiencia, actualmente la linea baja un poco mas y no debe ser el caso"
L5: "dejar las caras frontales de ese tono y que cuando se tenga el cursor por encima en lugar de cambiar a un tono mas claro para dar la retroalimentacion como actualmente sucede, que tal pasar unas lineas por encima del boton dando este efecto como de brillo o baso de vidrio limpio"
L6: "1. la animacion del efecto destello va demasiado rapido\n2. en donde se muestra la educacion formal y las certificaciones oficiales, debe haber un poco mas de espacion vertical entre los componentes porque sus sombras se estan juntando\n3. falta agregar estos estilos nuevos a los botones de lenguaje y contactame de la navbar, ademas del boton de VERMI GITHUB en la seccion de Aboutme"
L7: "1. dentro de la seccion de hero, la foto debe ser un poco mas grande\n2. los botones de redes sociales ya no se ven, deben verse y tener el nuevo estilo aplicado\n3. dentro de la seccion de portfolio las opciones de filtro tambien deben tener el nuevo estilo aplicado\n4. haz la animacion de destello un poco mas lenta y dime donde mover para yo poder ajustar manualmente"
L8: "1. lo que si me parece adecuado es una pequeña separacion perceptible entre las opciones de proyecto y la opcion que se usa para expandir las cards\n2. teniendo en cuenta lo que descubriste en el primer punto, necesito que por cada seccion por cada parte de esta v2, reviuses que todo esté modularizado, necesitamos DRY correctamente"
L9: "realiza los commits"
