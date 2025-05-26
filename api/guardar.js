import { MongoClient } from 'mongodb';

const uri = process.env.MONGODB_URI;
const client = new MongoClient(uri);

export default async function handler(req, res) {
    if (req.method !== 'POST') return res.status(405).end();

    const { nombre, email, edad, direccion } = req.body;

    try {
        await client.connect();
        const db = client.db("formulario_db");
        const collection = db.collection("usuarios");

        const resultado = await collection.insertOne({
            nombre,
            email,
            edad: parseInt(edad),
            direccion
        });

        res.status(200).json({ id: resultado.insertedId });
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: "Error al guardar en la base de datos" });
    }
}
