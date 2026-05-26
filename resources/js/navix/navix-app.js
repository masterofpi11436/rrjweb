import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

const container = document.getElementById('navix-container');

if (container) {
    const modelUrl = container.dataset.modelUrl;

    const models = JSON.parse(
        container.dataset.models || '[]'
    );

    const cameraX = parseFloat(container.dataset.cameraX || 2);
    const cameraY = parseFloat(container.dataset.cameraY || 2);
    const cameraZ = parseFloat(container.dataset.cameraZ || 5);

    const lightIntensity = parseFloat(container.dataset.lightIntensity || 2);
    const backgroundColor = container.dataset.backgroundColor || '#eeeeee';

    const scene = new THREE.Scene();
    scene.background = new THREE.Color(backgroundColor);

    const camera = new THREE.PerspectiveCamera(
        75,
        container.clientWidth / container.clientHeight,
        0.1,
        1000
    );

    camera.position.set(cameraX, cameraY, cameraZ);

    const renderer = new THREE.WebGLRenderer({ antialias: true });

    renderer.setSize(
        container.clientWidth,
        container.clientHeight
    );

    container.appendChild(renderer.domElement);
    

    scene.add(new THREE.AmbientLight(0xffffff, 0.8));

    const light = new THREE.DirectionalLight(0xffffff, lightIntensity);
    light.position.set(5, 5, 5);
    scene.add(light);

    const controls = new OrbitControls(camera, renderer.domElement);

    controls.enablePan = true;

    controls.minDistance = 2;
    controls.maxDistance = 100;

    controls.maxPolarAngle = Math.PI / 2;

    const loader = new GLTFLoader();

    if (modelUrl) {
        loader.load(modelUrl, (gltf) => {
            scene.add(gltf.scene);
        });
    }

    models.forEach((model) => {
        loader.load(model.url, (gltf) => {
            const object = gltf.scene;

            object.position.set(
                model.x || 0,
                model.y || 0,
                model.z || 0
            );

            const scale = model.scale || 1;

            object.scale.set(scale, scale, scale);

            scene.add(object);
        });
    });

    function animate() {
        requestAnimationFrame(animate);
        controls.update();
        renderer.render(scene, camera);
    }

    animate();
}