import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const sourceManifest = path.join(__dirname, "public/build/.vite/manifest.json");
const targetManifest = path.join(__dirname, "public/build/manifest.json");

if (fs.existsSync(sourceManifest)) {
    fs.copyFileSync(sourceManifest, targetManifest);
    console.log("✅ Manifest copied to public/build/manifest.json");
} else {
    console.log("❌ Source manifest not found at:", sourceManifest);
}
