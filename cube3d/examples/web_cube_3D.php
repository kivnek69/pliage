
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>three.js webgl - interactive cubes</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <script src="https://rawgithub.com/mrdoob/three.js/master/build/three.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <style>
body {
    font-family: Monospace;
				background-color: #f0f0f0;
				margin: 0px;
				overflow: hidden;
			}
		</style>
	</head>
	<body>

    <div class="centre">

		<script src="../build/three.min.js"></script>

		<script src="js/libs/stats.min.js"></script>


		<script>



			var container, stats;
			var camera, scene, raycaster, renderer;

			var mouse = new THREE.Vector2(), INTERSECTED;
			var radius = 300, theta = 0;

			init();
			animate();

			function init() {




                container = document.createElement( 'div' );
                document.body.appendChild( container );
                <?php $images = array(
                     "http://40.media.tumblr.com/c34b736b58de68d86e77129b1d463db6/tumblr_ni1iroS5aX1u7h7nro1_500.jpg",
                     "http://41.media.tumblr.com/9e531e011ea9a4fc2763506ffc39a3f8/tumblr_ni1in9QFv71u7h7nro1_500.jpg",
                     "http://40.media.tumblr.com/d9284b82acda0aebd3eab41da4c1cbc9/tumblr_ni1ix1GUEu1u7h7nro1_500.jpg",
                   "http://41.media.tumblr.com/b6726c35c35a7ee7655d96739728ac8b/tumblr_ni1ik84QMr1u7h7nro1_500.jpg",
                     "http://41.media.tumblr.com/29d40f670b186deb7a3d61481a6a5c5f/tumblr_ni1ij3KJJg1u7h7nro1_500.jpg",
                   "http://40.media.tumblr.com/85448a8c9e8509f064d298e5f2d075b9/tumblr_ni1ib3y5xh1u7h7nro1_500.jpg",
                     "http://40.media.tumblr.com/c9e77bb9ad5f538b2ebd5bf7d2a61377/tumblr_ni1i1epQzR1u7h7nro1_500.jpg",
                     "http://41.media.tumblr.com/3cf31745db0299a7990d1360f81c8f51/tumblr_ni1hym5ktE1u7h7nro1_500.png",
                     "http://41.media.tumblr.com/6dd5efa097d90cf559bdf8ce63bab041/tumblr_ni1hv2YYQL1u7h7nro1_500.jpg",
                     "http://40.media.tumblr.com/73c80faacabfae6a069ceff8d4ef2b08/tumblr_ni1hqaBp2f1u7h7nro1_500.jpg",
                   "http://41.media.tumblr.com/868a98137c3ecd9e96f95703f39ec84d/tumblr_ni1hpnCLPU1u7h7nro1_500.jpg",
                     "http://41.media.tumblr.com/469b7ef448a9f1b0ec566aa02aa1f90a/tumblr_ni1hktXHCl1u7h7nro1_500.jpg",
                     "http://40.media.tumblr.com/54dfe9db2c691c35b7572f141774da2a/tumblr_ni1hfdOnJf1u7h7nro1_500.jpg",
                      "http://40.media.tumblr.com/4469ea1fed006b227499054027afd3fb/tumblr_ni1hbx2pqJ1u7h7nro1_500.jpg",
                     "http://40.media.tumblr.com/d6f6a24b755027c5ccdb1e6ef4a6b75d/tumblr_ni1hafEdc11u7h7nro1_500.jpg"
                    );?>

                var info = document.createElement( 'div' );
                info.style.position = 'absolute';
                info.style.top = '10px';
                info.style.width = '100%';
                info.style.textAlign = 'center';
                container.appendChild( info );

                camera = new THREE.PerspectiveCamera( 70, 500 / 300, 1, 10000 );

                scene = new THREE.Scene();

                var light = new THREE.DirectionalLight( 0xffffff, 1 );
                light.position.set( 1, 1, 1 ).normalize();
                scene.add( light );

                var geometry = new THREE.BoxGeometry( 0, 100, 100 );


                for ( var i = 0; i < 2; i ++ ) {
                    <?php

                    foreach($images as $tof ){



                    ?>


                    THREE.ImageUtils.crossOrigin = 'anonymous';


                    var material = new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture("<?php echo $tof;?>") } );


                    var object = new THREE.Mesh( geometry,material );





					object.position.x = Math.random() * 800 - 400;
					object.position.y = Math.random() * 800 - 400;
					object.position.z = Math.random() * 800 - 400;

					object.rotation.x = Math.random() * 2 * Math.PI;
					object.rotation.y = Math.random() * 2 * Math.PI;
					object.rotation.z = Math.random() * 2 * Math.PI;

					object.scale.x = Math.random() + 0.5;
					object.scale.y = Math.random() + 0.5;
					object.scale.z = Math.random() + 0.5;

					scene.add( object );
                    <?php }?>

				}

				raycaster = new THREE.Raycaster();

				renderer = new THREE.WebGLRenderer();
				renderer.setClearColor( 0xf0f0f0 );
				renderer.setSize(200,200);
				renderer.sortObjects = false;
				container.appendChild(renderer.domElement);

				stats = new Stats();
				stats.domElement.style.position = 'absolute';
				stats.domElement.style.top = '0px';
				container.appendChild( stats.domElement );

				document.addEventListener( 'mousemove', onDocumentMouseMove, false );

				//

				window.addEventListener( 'resize', onWindowResize, false );

			}

			function onWindowResize() {

                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();

                renderer.setSize( window.innerWidth, window.innerHeight );

            }

			function onDocumentMouseMove( event ) {

                event.preventDefault();

                mouse.x = ( event.clientX / window.innerWidth ) * 2 - 1;
                mouse.y = - ( event.clientY / window.innerHeight ) * 2 + 1;

            }

			//

			function animate() {

                requestAnimationFrame( animate );

                render();
                stats.update();

            }

			function render() {

                theta += 0.1;

                camera.position.x = radius * Math.sin( THREE.Math.degToRad( theta ) );
                camera.position.y = radius * Math.sin( THREE.Math.degToRad( theta ) );
                camera.position.z = radius * Math.cos( THREE.Math.degToRad( theta ) );
                camera.lookAt( scene.position );

                // find intersections

                var vector = new THREE.Vector3( mouse.x, mouse.y, 1 ).unproject( camera );

                raycaster.set( camera.position, vector.sub( camera.position ).normalize() );



                renderer.render( scene, camera );

            }

		</script>
    </div>



    <script type="text/javascript">

    $( document ).ready(function() {

        $('#stats').css('display','none');
    });

    </script>

	</body>
</html>
